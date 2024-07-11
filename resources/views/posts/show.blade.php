@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container flex mx-auto lg:m-20">
        <div class="w-1/2 flex flex-col">
            <img class="w-4/5 h-2/3" src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen de post {{ $post->title }}">
            <div class="h-1/3">
                <div class="p-3">
                    <p>Likes 0</p>
                </div>

                <div>
                    <p class="font-bold">{{ $post->user->username }}</p>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="mt-5">{{ $post->description }}</p>
                </div>
            </div>
        </div>
        <div class="w-1/2">2</div>
    </div>
@endsection
