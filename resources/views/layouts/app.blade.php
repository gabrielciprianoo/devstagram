<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}" rel="stylesheet"> --}}
        <title>DevStagram - @yield('title')</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">

        <header class="p-5 bg-white shadow border-b">
            <div class="container mx-auto flex flex-col gap-5 md:flex-row justify-between items-center">
                <h1> <a class="text-3xl font-black" href="/">DevStagram</a></h1>

                @auth
                <nav class="flex gap-5 items-center">
                    <a class="font-bold text-gray-600 text-sm" href="#">Hola: <span class="font-normal">{{ auth()->user()->username }}</span></a>
                    <form action="{{ route('logout')}}" method="POST">
                        @csrf
                        <button class="font-bold uppercase text-gray-600 text-sm" type="submit"">Cerrar Sesión</button>
                    </form>
                </nav>
                @endauth

                @guest
                <nav class="flex gap-5 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
                </nav>
                @endguest
            </div>  
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-3xl text-center mb-10 mx-2 md:mx-0">@yield('title')</h2>
            @yield('content')
        </main>

        <footer class="text-center text-gray-600 uppercase p-5 font-bold mt-10">
            devstagram - todos los derechos reservados {{now()->year}} ©
        </footer>

        
       
    </body>
</html>
