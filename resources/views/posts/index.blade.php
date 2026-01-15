<x-app-layout>
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <p class="text-green-600">{{ session('status') }}</p>
                    @endif

                    <h3 class="font-semibold mb-4">Add new post</h3>
                    <form action="{{ route('posts.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                        >
                        @error('title')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror

                        <label class="block text-sm font-medium text-gray-700" for="content">Content</label>
                        <textarea
                            id="content"
                            name="content"
                            rows="5"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror

                        <label class="block text-sm font-medium text-gray-700" for="category_id">Category</label>
                        <select
                            id="category_id"
                            name="category_id"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                        >
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md">
                            Add
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold mb-4">Posts</h3>
                    @if ($posts->isEmpty())
                        <p>No posts yet.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($posts as $post)
                                <li class="flex items-center gap-4">
                                    <span>{{ $post->title }}</span>
                                    <span class="text-sm text-gray-500">
                                        {{ $post->category?->name ?? 'Uncategorized' }}
                                    </span>
                                    <a
                                        href="{{ route('posts.show', $post) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        View
                                    </a>
                                    <a
                                        href="{{ route('posts.edit', $post) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
