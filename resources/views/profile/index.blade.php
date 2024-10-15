@extends('layouts.app')

@section('title')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <div class="md:w-4/12 bg-white p-6 rounded shadow-xl">
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" placeholder="Ingres tu nombre de usuario" id="username" name="username"
                        class="border p-3 rounded-lg w-full @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}">
        
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Imagen de perfil</label>
                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png"
                </div>

                
                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 mt-5 hover:bg-sky-900 cursor-pointer uppercase font-bold transition-colors w-full p-3 text-white rounded-lg">
            
            </form>
        </div>
        
    </div>
@endsection
