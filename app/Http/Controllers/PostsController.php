<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use Illuminate\Support\Facades\Auth;
use Image;
//use App\Http\Controllers\Storage;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $posts)
    {
        $userID = Auth::id();

        //
        //return Storage::disk('s3')->response('images/'.$posts->image);
        $user = User::findOrfail($userID);

        // foreach ($user->posts as $post)
        // {
        //     return  $post->image;
        // }


       return view('posts.index')->with('posts',Post::all())->with('user',$user);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //fetch all in category models

        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request, Post $post)
    {

       //dd($request->all());
        //upload the image
       ///$image = $request->image->store('posts');
        $path = $request->file('image')->store('images', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');
      //image intervention
//       $image = $request->file('image');
//       $image_name = time() . '.' . $image->getClientOriginalExtension();

//       $destinationPath = public_path('/thumbnail');
//             if (!file_exists($destinationPath)) {
//                 mkdir($destinationPath, 666, true);
//             }

//       $resize_image = Image::make($image->getRealPath());

//       $resize_image->resize(120, 60, function($constraint) {

//         $constraint->aspectRatio();

//       })->save($destinationPath . '/' . $image_name);

//       $destinationPath = public_path('/images');


//       $image->move($destinationPath, $image_name);

//    dd($destinationPath . '/' . $image_name)->all();

        //////create the post
        $post = Post::create([

            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => Storage::disk('s3')->url($path),
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'filename' => $path

        ]);

         if ($request->tags){
             $post->tags()->attach($request->tags);
        }

        // //flash message

        // //redirect users

        return redirect(route('posts.index'))->with('status', 'Post created successfully');
    //    return $post;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request,Post $post)
    {
        $data = $request->only(['title', 'description', 'published_at', 'content']);




        //check if new image
        if ($request->hasFile('image')){
            // update it
            //$image = $request->image->store('posts');
            $path = $request->file('image')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            // delete old one
            Storage::disk('s3')->delete($post->filename);
            // $post->deleteImage();
            $data['image'] = Storage::disk('s3')->url($path);
            //dd($data);
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        // update attributes
        $post->update($data);
        //redirect user
       return redirect(route('posts.index'))->with('status', 'Post updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //


      $post = Post::withTrashed()->where('id',$id)->firstOrFail();

       if ($post->trashed()){
        /////$path = 'test.txt';
        /////Storage::disk('s3')->put($path, 'hello');
      ///// Storage::disk('s3')->delete($path);
           //return $post->image;

           if(Storage::disk('s3')->exists($post->filename)) {
            Storage::disk('s3')->delete($post->filename);
         } else {
            $post->deleteImage();
            $post->forceDelete();

         }


           return redirect(route('trashed-posts.index'))->with('status', 'Post deleted successfully');
       }
       else {
        $post->delete();
        return redirect(route('posts.index'))->with('status', 'Post deleted successfully');
       }

        // return redirect(route('posts.index'))->with('status', 'Post deleted successfully');

    }

    //list of trash post
    public function trashed(){

        $trashed= Post::withTrashed()->whereNotNull('deleted_at')->get();

        return view('posts.index')->with('posts', $trashed);

    }

       //list of trash post
       public function restore($id)
       {
           //
          // dd($id);
            $restore = Post::withTrashed()->where('id',$id)->firstOrFail();
           $restore->restore();
           return redirect(route('trashed-posts.index'))->with('status', 'Post restore successfully')->with('restore', $restore);
       }

}
