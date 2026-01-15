<x-app-layout>
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <p class="text-sm text-gray-500">
                        Category: {{ $post->category?->name ?? 'Uncategorized' }}
                    </p>
                    <div class="prose max-w-none">
                        {{ $post->content }}
                    </div>
                    <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">
                        Back to posts
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
