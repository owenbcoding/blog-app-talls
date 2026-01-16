@extends('layouts.app')

@section('content')
    <header class="py-5 bg-gray-100 border-b mb-4">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        </div>
    </header>

    <div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img
                class="w-full h-64 object-cover"
                src="{{ $post->imageUrl(1000, 500) }}"
                alt="{{ $post->title }}"
            >
            <div class="p-6 text-gray-900 space-y-4">
                <p class="text-sm text-gray-500">
                    Category: {{ $post->category?->name ?? 'Uncategorized' }}
                </p>
                <div class="prose max-w-none">
                    {{ $post->content }}
                </div>
                <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                    Back to posts
                </a>
            </div>
        </div>
    </div>
@endsection
