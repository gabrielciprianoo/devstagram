@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="Imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <p class="text-gray-700 text-2xl pt-5">{{ $user->username }}</p>
                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">0 <span class="font-normal">Seguidores</span></p>
                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">0 <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">0 <span class="font-normal">Post</span></p>
            </div>
        </div>
    </div>

    <section class="container mx-auto m-20">
        <h2 class="text-4xl text-center font-black my-10">Publicaciónes</h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href=" {{route('posts.show',['user' => $user, 'post' => $post])}}">
                            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen de post {{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">{{$posts->links()}}</div>
        @else
            <p class="text-xl text-center text-gray-600 my-20">No Hay Publicaciónes</p>
        @endif
    </section>
@endsection
