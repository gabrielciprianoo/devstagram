@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5 ">
                @if ($user->image)
                    <img src="{{ asset('profiles/' . $user->image) }}" alt="Imagen de usuario">
                @else
                    <img src="{{ asset('img/usuario.svg') }}" alt="Imagen de usuario">
                @endif

            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <div class="flex gap-2 items-center pt-5">
                    <p class="text-gray-700 text-2xl ">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href= " {{ route('profile.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>


                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">0 <span class="font-normal">Seguidores</span></p>
                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">0 <span class="font-normal">Siguiendo</span></p>
                <p class="text-gray-800 text-sm mt-5 mb-3 font-bold">{{$user->posts->count()}} <span class="font-normal">Post</span></p>
            </div>
        </div>
    </div>

    <section class="container mx-auto m-20">
        <h2 class="text-4xl text-center font-black my-10">Publicaciónes</h2>
        @if ($posts->count())
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href=" {{ route('posts.show', ['user' => $user, 'post' => $post]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen de post {{ $post->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">{{ $posts->links() }}</div>
        @else
            <p class="text-xl text-center text-gray-600 my-20">No Hay Publicaciónes</p>
        @endif
    </section>
@endsection
