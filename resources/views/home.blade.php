@extends('layouts.app')

@section('content')
    <header class="py-5 bg-gray-100 border-b mb-4 h-60 relative overflow-hidden">
        <div class="container mx-auto text-center mt-16 relative">
            <h1 class="text-3xl font-bold">Blog</h1>
        </div>
    </header>
    <div class="container mx-auto px-4">
        <div class="mb-6">
            <h3 class="font-semibold text-center mb-3">Categories</h3>
            <ul class="flex flex-wrap justify-center gap-3">
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="px-3 py-1 rounded-full border text-sm {{ !request('category') ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 border-gray-300 hover:border-gray-400' }}"
                    >
                        All Posts
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a
                            href="{{ route('home', ['category' => $category->id]) }}"
                            class="px-3 py-1 rounded-full border text-sm {{ request('category') == $category->id ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 border-gray-300 hover:border-gray-400' }}"
                        >
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="container mx-auto px-4 mt-10">
        <div class="max-w-5xl mx-auto space-y-6">
            <h2 class="text-2xl font-bold text-center mb-4">Latest Posts</h2>
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
                            <h2 class="text-xl font-semibold mb-2"><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h2>
                            <p class="text-gray-700 mb-4">{{ substr($post->content, 0, 100) }}...</p>
                            <a class="inline-block bg-blue-500 text-white px-4 py-2 rounded" href="{{ route('post.show', $post) }}">Read more →</a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($posts->count() > 4)
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
                @endif
        </div>
    </div>
@endsection
