<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel')}}/@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- script --}}
    <script src="@yield('jsName')"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} / @yield('title')
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                {{-- Modal button --}}
                                <button type="button" class="border-0 bg-light pt-2 nav-link" data-bs-toggle="modal" data-bs-target="#createword">
                                    Register Words
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Register Word!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- body --}}
                                            <div class="container">
                                                <form action="{{route('words.store')}}" method="post">
                                                    @csrf
                                                    @method('post')
                                                    <div class="mb-3">
                                                        <div class="form-text">Word</div>
                                                        <input type="text" name="word" id="word" class="form-control">
                                                        @error('word')
                                                            <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="form-text">Definition</div>
                                                        <input type="text" name="definition" id="definition" class="form-control">
                                                        @error('definition')
                                                            <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4">
                                                        <select name="words_type_id" id="words_type_id" class="form-select">
                                                            <option value="" hidden>Select a word type</option>
                                                            @foreach ($types as $type)
                                                                <option value="{{$type->id}}">{{$type->type}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('words_type_id')
                                                            <div class="text-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-outline-primary">Register!</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                {{-- Modal button --}}
                                <button type="button" class="border-0 bg-light pt-2 nav-link" data-bs-toggle="modal" data-bs-target="#createtype">
                                    Add Word Type
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createtype" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Word Type!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- body --}}
                                            <div class="container">
                                                <form action="/types" method="post">
                                                    @csrf
                                                    @method('post')

                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Type</label>
                                                        <input type="text" name="type" id="type" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-outline-primary w-100">Add!</button>
                                                    </div>
                                                </form>

                                                <ul class="list-group">
                                                    <h5 class="text-center mt-3">Type Overview</h5>
                                                    @foreach ($types as $type)
                                                        <li class="list-group-item mb-1">{{$type->type}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="/users/{{Auth::user()->uuid}}" class="dropdown-item">Profile</a>
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

        <main class="container py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
