<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include("partiels._head")
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col">
                {{-- @if (Auth::check()) --}}
                @auth
                    {{-- Bienvenue {{ Auth::user()->name }} --}}
                    <span>Bienvenue {{ Auth::user()->name }}</span>
                    {{-- <span>Bienvenue {{ auth()->user()->name }}</span> --}}

                    <a class="btn btn-link" href="{{ url('/home') }}">Profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="form-inline d-inline-block">
                        @csrf
                        <input type="submit" value="Me déconnecter" class="btn btn-link form-control">
                    </form>
                @else
                    @if (Route::has('login'))                    
                    <a class="btn btn-link" href="{{ route('login') }}">Connexion</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-link" href="{{ route('register') }}">Créer un compte</a>
                    @endif
                @endauth
                {{-- @endif --}}
            </div>
        </div>

        <div class="row mt-5">
            <div class="col d-flex justify-content-center">
                <h1>@yield("titre")</h1>
            </div>
        </div>
        
        @include("partiels._menu")
                    <div class="row">
            <div class="col">
                @if(\Session::has("success"))
                    <div class="alert alert-success">{{\Session::get("success")}}</div>
                @endif
            </div>
        </div>
        @yield("contenu")

    </div>

</body>
</html>
