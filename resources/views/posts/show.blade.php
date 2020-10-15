@extends('layouts.app')


@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div>

    <div class="card card-default">

        <div class="card-header">
            Posts
        </div>

        <div class="card-body">
            @include('partials.errors')
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
                    @foreach ($posts as $post)

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

                        @if ($post->trashed())

                        <td>
                            <form action="{{route('restore-posts.index', $post->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                               <button class="btn btn-success btn-sm float-right">Restore</button>

                            </form>
                        </td>

                        @else


                        <td>

                            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm float-right text-light">Edit</a>

                        </td>

                        @endif
                        <td>
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm float-right">

                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}

                                </button>
                            </form>
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
