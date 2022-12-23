<x-frontend-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($category->menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ asset('/').$menu->image }}"
                    alt="Image" />
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                            <span class="text-white bg-gradient-to-r from-green-400 to-blue-500 hover:from-blue-500 hover:to-green-400 rounded-full text-sm px-4 py-0.5">{{ $menu->name }}</span>
                        </div>
                        <p class="leading-normal text-gray-700">{{$menu->description}}</p>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xl text-green-600">{{$menu->price}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-frontend-layout>
