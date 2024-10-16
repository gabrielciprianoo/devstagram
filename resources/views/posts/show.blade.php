@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container flex flex-col md:flex-row justify-center px-5 gap-5 rounded-sm ">
        <div class=" md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen de post {{ $post->title }}">
            <div class="h-1/3">
                <div class="p-3 flex items-center gap-4">
                    @auth
                        @if ($post->checkLike(auth()->user()))
                            <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div class="py-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </button>

                                </div>
                            </form>
                        @else
                            <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                @csrf
                                <div class="py-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </button>

                                </div>
                            </form>
                        @endif
                    @endauth
                    <p>{{ $post->likes->count()}} Likes</p>
                </div>

                <div>
                    <p class="font-bold">{{ $post->user->username }}</p>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="mt-5">{{ $post->description }}</p>
                </div>
                @auth
                    @can('delete', $post)
                        <form action=" {{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Eliminar Publicacion"
                                class="bg-red-500 mt-5 hover:bg-red-900 cursor-pointer uppercase font-bold transition-colors w-full md:w-auto py-3 px-4 text-white rounded-lg">

                        </form>
                    @endcan
                @endauth
            </div>

        </div>
        <div class="md:w-1/2 md:h-1/2 bg-white shadow-sm px-10 pb-5">
            <div>
                <h2 class="font-bold text-center text-2xl my-5">Comentarios</h2>
                @if (session('message'))
                    <p class="bg-green-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase font-bold mb-4">
                        {{ session('message') }}</p>
                @endif
                @auth

                    <form action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">Agrega un
                                comentario:</label>
                            <textarea type="text" placeholder="Escribe un comentario en la publicación" id="comment" name="comment"
                                rows="5"
                                class="border p-3 rounded-lg w-full @error('comment')
                            border-red-500
                        @enderror">{{ old('comment') }}</textarea>

                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-900 cursor-pointer uppercase font-bold transition-colors w-full md:w-auto py-3 px-4 text-white rounded-lg">

                    </form>
                @endauth
            </div>

            <div class="bg-gray-100 shadow-sm max-h-80  overflow-y-scroll mt-10">
                @if ($post->comments->count())
                    @foreach ($post->comments as $comment)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comment->user) }}"
                                class="font-bold">{{ $comment->user->username }}</a>
                            <p>{{ $comment->comment }}</p>
                            <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-xl text-gray-500 p-5 text-center"> No hay comentarios</p>
                @endif
            </div>
        </div>
    </div>
@endsection
