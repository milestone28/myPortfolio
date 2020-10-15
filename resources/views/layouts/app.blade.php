<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('users.edit-profile') }}">
                                       
                                        My Profile
                                    </a>
                                                                        
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
      
        <main class="py-4">

            @auth
            <div class="container">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif



           

                    <div class="row">
                        <div class="col-4">
                          <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action {{ Request::is('home') ? 'active' : '' }}"  href="{{ route('home') }}"  >Dashboard</a>
                            @if(auth()->user()->isAdmin())
                            <a class="list-group-item list-group-item-action {{ Request::is('users') ? 'active' : '' }}"  href="{{ route('users.index') }}"  >Users</a>
                            @endif
                            <a class="list-group-item list-group-item-action {{ Request::is('posts') ? 'active' : '' }}"  href="{{ route('posts.index') }}"  >Posts</a>
                            <a class="list-group-item list-group-item-action {{ Request::is('categories') ? 'active' : '' }}"  href="{{ route('categories.index') }}"  >Categories</a>
                            <a class="list-group-item list-group-item-action {{ Request::is('tags') ? 'active' : '' }}"  href="{{ route('tags.index') }}"  >Tags</a>
                          </div>

                          <ul class="list-group mt-5">
                        
                            
                                <a class="list-group-item list-group-item-action {{ Request::is('trashed-posts') ? 'active' : '' }}"  href="{{ route('trashed-posts.index') }}"  >Trashed Posts</a>
                           
                        </ul>

                        </div>
                    
                    
                    {{-- </div>
                  </div>

                <div class="row">
                    <div class="col-md-4">
                        
                        <ul class="list-group">


                             <li class="list-group-item">
                                <a href="{{ route('home') }}">Dashboard</a>
                            </li>

                            @if(auth()->user()->isAdmin())

                            <li class="list-group-item">
                                 <a href="{{ route('users.index') }}">
                                     Users
                                 </a>
                             </li>
 
                             @endif


                            <li class="list-group-item">
                                <a href="{{ route('posts.index') }}">Posts</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('categories.index') }}">Categories</a>
                            </li>

                            <li class="list-group-item">
                                <a href="{{ route('tags.index') }}">Tags</a>
                            </li> 

                        </ul>

                        
                        <ul class="list-group mt-5">
                        
                            <li class="list-group-item">
                                <a href="{{ route('trashed-posts.index') }}">Trashed Posts</a>
                            </li>
                        </ul>

                    </div> --}}

                    <div class="col-md-8">
                        @yield('content')
                    </div>

                </div>
            </div>
            @else
            
            @yield('content')

            @endauth
        </main>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> --}}

        <!-- Scripts deleted defer script in default laravel-->
        <script src="{{ asset('js/app.js') }}">
        </script>

       
           
         

@yield('scripts')

</body>
</html>
