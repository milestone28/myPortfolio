<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class PostsController extends Controller
{
    //

    public function show(Post $post) {

        return view('blog.show')->with('post', $post);

    }

    public function category(Category $category) {



        return view('blog.category')
         ->with('category', $category)
        ->with('tags', Tag::all())
         ->with('posts', Post::searched()->simplePaginate(4))
         ->with('categories', Category::all());

    }

    public function tag(Tag $tag) {



        return view('blog.tag')
        ->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(3));

    }

}
