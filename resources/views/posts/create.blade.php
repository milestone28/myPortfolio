@extends('layouts.app')


@section('content')

    <div class="card card-default">
    
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </div>

        <div class="card-body">

            @include('partials.errors')
            
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                @method('PUT')
            @endif
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="ex. Salamat Shoppee" value="{{ isset($post) ? $post->title : null}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="ex. Shopee is a Singaporean e-commerce platform headquartered under Sea Group (previously known as Garena)">{{ isset($post) ? $post->description : null}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        {{-- <textarea class="form-control" name="content" id="content" cols="5" rows="5"></textarea> --}}
                        {{-- trix editor --}}
                        <input id="content" type="hidden" name="content"  value="{{ isset($post) ? $post->content : ''}}">
                        <trix-editor input="content"></trix-editor>
                    </div>

                    <div class="form-group">
                        <label for="published_at">Published At</label>
                        <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : ''}}">
                    </div>
                    
                    @if (isset($post))
                        <div class="form-group">
                            <img src="{{ asset("storage/".$post->image) }}" alt="{{ asset($post->title) }}" style="width: 100%">
                        </div>
                        
                    @endif
                    
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label for="category" >Category</label>
                        <select name="category" id="category" class="form-control">
                            
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if (isset($post))
                                        @if ($category->id == $post->category_id)
                                        selected
                                        @endif
                                    @endif

                                    > 
                                    {{ $category->name }}
                                </option>
                                    
                                @endforeach
                            
                        </select>
                        
                    </div>

                @if ($tags->count() > 0)
                    <div class="form-group">
                        
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        
                                        @if (isset($post))

                                            @if ($post->hasTag($tag->id))

                                            selected
                                                
                                            @endif
                                            
                                        @endif

                                        >
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                        </select>
                                                   
                    </div>
                @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
                    </div>

            </form> 
        </div>
        
    </div>   
    
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        });

        {{-- // In your Javascript (external .js resource or <script> tag) --}}
    $(document).ready(function() {
        $('.tags-selector').select2();
    });
    </script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


@endsection

@section('css')
                            {{-- plugins --}}
    {{-- trix for content --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css">
    {{-- flatpickr for dates and time --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- select2 for tags --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

