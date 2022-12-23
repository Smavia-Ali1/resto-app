<x-frontend-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($categories as $category)
            <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                <img class="w-full h-48" src="{{ asset('/').$category->image }}"
                alt="Image" />
                <div class="px-6 py-4">
                    <div class="flex mb-2">
                        <a href="{{ route('category.show', $category->id) }}" class="text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-blue-500 hover:to-green-400 rounded-lg text-sm px-2 py-2">
                            <h4 class="px-4 py-0.5">{{ $category->name }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-frontend-layout>
