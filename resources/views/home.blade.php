@extends('layouts.app')


@section('content')

  

    <div class="card card-default">

        <div class="card-header">
            Dashboard
        </div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            @if ($posts->count() > 0)


            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
               
                    @foreach ($user->posts as $post)

                    <tr>

                        <td>
                            <img src="{{ asset($post->image) }}" alt="{{ $post->image }}" width="120px" height="60px">

                        </td>
                        <td>
                            {{  $post->title }}
                        </td>

                        <td>
                            <a href="{{ route('categories.edit',$post->category->id) }}">
                                {{ $post->category->name }}
                            </a>
                        </td>

                       

                        <td>
                          
                        </td>

                      


                        <td>

                         

                        </td>

                       
                        <td>
                           
                        </td>




                    </tr>

                    @endforeach
                </tbody>

            </table>
                @else



               @if (Route::current()->getName() == 'trashed-posts.index')
               <h3 class="text-center text-muted">No Files Deleted</h3>
               @else
               <h3 class="text-center text-muted">No Post Available</h3>
               @endif


            @endif

        </div>

    </div>

@endsection
