@extends('layouts.app')

@section('title')
    Crea Una Publicación
@endsection

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="/images" enctype="multipart/form-data" method="POST" class="dropzone border-dahsed border-2 w-full h-96 rounded flex flex-col justify-center items-center" id="dropzone"></form>
        </div>
        <div class="md:w-1/2 bg-white p-10 rounded shadow-xl m-6 md:m-0">
            <form action="{{ route('posts.create') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">Titulo de la
                        publicación:</label>
                    <input type="text" placeholder="Escribre un titulo para tu publicación" id="title" name="title"
                        class="border p-3 rounded-lg w-full @error('title')
                        border-red-500
                    @enderror"
                        value="{{ old('title') }}">
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Descripción:</label>
                    <textarea type="text" placeholder="Contenido te tu publicación" id="description" name="description" rows="5"
                        class="border p-3 rounded-lg w-full @error('description')
                        border-red-500
                    @enderror">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>


                <input type="submit" value="Crear publicación"
                    class="bg-sky-600 hover:bg-sky-900 cursor-pointer uppercase font-bold transition-colors w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
