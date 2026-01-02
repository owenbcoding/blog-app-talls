@extends('layouts.app')

@section('content')
<main class="container mx-auto mt-6 flex justify-center">
    <!-- Blog Article Section -->
    <section class="w-3/5 bg-white p-6 shadow-md rounded-lg mb-10">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <img class="w-full rounded mb-4" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="...">
        <p class="text-gray-600 mb-4">Published on <span class="font-semibold">March 2, 2025</span></p>
        <div class="text-gray-800 space-y-4">
            <p>{{ $post->text }}</p>
        </div>
    </section>
</main>
@endsection