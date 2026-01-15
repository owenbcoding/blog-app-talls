<x-app-layout>
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <p class="text-green-600">{{ session('status') }}</p>
                    @endif

                    <h3 class="font-semibold mb-4">Add new category</h3>
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                        >
                        @error('name')
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
                    <h3 class="font-semibold mb-4">Categories</h3>
                    @if ($categories->isEmpty())
                        <p>No categories yet.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($categories as $category)
                                <li class="flex items-center gap-4">
                                    <span>{{ $category->name }}</span>
                                    <a
                                        href="{{ route('categories.edit', $category) }}"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
