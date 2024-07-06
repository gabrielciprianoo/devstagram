@extends('layouts.app')

@section('title')
    Inicia Sesión En DevStagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-5 md:h-full">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de Usuarios" class="md:h-full object-cover">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded shadow-xl">
            <form action="{{ route('login') }}" method="POST">
                @csrf

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" placeholder="Tu email" id="email" name="email"
                        class="border p-3 rounded-lg w-full @error('email')
                            border-red-500
                        @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" placeholder="Ingresa tu contraseña" id="password" name="password"
                        class="border p-3 rounded-lg w-full @error('password')
                            border-red-500
                        @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5 flex items-center gap-1">
                    <input type="checkbox" name="remember">
                    <label class=" text-gray-500 font-regular text-sm">Mantener mi sesión iniciada</label>
                    
                    
                </div>

                <input type="submit" value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-900 cursor-pointer uppercase font-bold transition-colors w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
