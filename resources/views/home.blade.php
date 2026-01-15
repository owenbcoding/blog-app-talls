@extends('layouts.app')

@section('content')
    <header class="py-5 bg-gray-100 border-b mb-4 h-60">
        <div class="container mx-auto text-center mt-16">
            <h1 class="text-3xl font-bold">Blog Site</h1>
        </div>
    </header>
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Blog entries -->
            <div class="lg:col-span-2 space-y-6">
            <h2 class="text-2xl font-bold mb-4">Latest Posts</h2>
                <!-- Featured blog post -->
                @php
                    $featuredPost = $posts->first();
                @endphp
                <article class="bg-white rounded-lg shadow overflow-hidden">
                    <img
                        class="w-full h-48 object-cover"
                        src="{{ $featuredPost ? $featuredPost->imageUrl(850, 350) : 'https://dummyimage.com/850x350/dee2e6/6c757d.jpg' }}"
                        alt="{{ $featuredPost?->title ?? 'Featured post image' }}"
                    >
                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-2">January 1, 2023</div>
                        <h2 class="text-2xl font-bold mb-2">
                            {{ $featuredPost?->title ?? 'Featured Post Title' }}
                        </h2>
                        <p class="text-gray-700 mb-4">
                            {{ $featuredPost ? substr($featuredPost->content, 0, 160) . '...' : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.' }}
                        </p>
                        @if ($featuredPost)
                            <a class="inline-block bg-blue-500 text-white px-4 py-2 rounded" href="{{ route('post.show', $featuredPost) }}">
                                Read more →
                            </a>
                        @endif
                    </div>
                </article>

                <!-- Blog posts grid -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Blog post -->
                    @foreach ($posts as $post)
                    <article class="bg-white rounded-lg shadow overflow-hidden">
                        <img
                            class="w-full h-48 object-cover"
                            src="{{ $post->imageUrl(700, 350) }}"
                            alt="{{ $post->title }}"
                        >
                        <div class="p-4">
                            <div class="text-sm text-gray-500 mb-2">January 1, 2023</div>
                            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('post.show', $post) }}">{{ $post->title }}</h2>
                            <p class="text-gray-700 mb-4">{{ substr($post->content, 0, 100) }}...</p>
                            <a class="inline-block bg-blue-500 text-white px-4 py-2 rounded" href="{{ route('post.show', $post) }}">Read more →</a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination" class="mt-6">
                    <hr class="mb-4">
                    <ul class="flex justify-center space-x-2 mt-10">
                        <li><span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Newer</span></li>
                        <li><a class="px-3 py-1 bg-blue-500 text-white rounded" href="#!">1</a></li>
                        <li><a class="px-3 py-1 bg-gray-200 text-gray-700 rounded" href="#!">2</a></li>
                        <li><a class="px-3 py-1 bg-gray-200 text-gray-700 rounded" href="#!">3</a></li>
                        <li><a class="px-3 py-1 bg-gray-200 text-gray-700 rounded" href="#!">...</a></li>
                        <li><a class="px-3 py-1 bg-gray-200 text-gray-700 rounded" href="#!">15</a></li>
                        <li><a class="px-3 py-1 bg-gray-200 text-gray-700 rounded" href="#!">Older</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Side widgets -->
            <div class="space-y-6">
                <!-- Search widget -->
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold mb-4">Search</h3>
                    <div class="flex">
                        <input class="w-full border rounded-l px-3 py-2" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-r" id="button-search" type="button">Go!</button>
                    </div>
                </div>
                <!-- Categories widget -->
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 {{ !request('category') ? 'font-bold text-blue-600' : '' }}">
                                All Posts
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('home', ['category' => $category->id]) }}" 
                                   class="text-gray-600 hover:text-gray-800 {{ request('category') == $category->id ? 'font-bold text-blue-600' : '' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
