<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <a href="{{ route('admin.tables.index') }}" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">View Tables</a>
            </div>
            <div class="px-2 py-0.5 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.tables.update',$table->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name* </label>
                            <div class="mt-1">
                                <input type="text" id="name" value="{{ $table->name }}" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror"/>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number* </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" value="{{ $table->guest_number }}" wire:model.lazy="guest_number" name="guest_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror"/>
                                @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                <select name="status" id="status" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('status') border-red-400 @enderror">
                                    <option value="">Select Status</option>
                                    @foreach (App\Enums\TableStatus::cases() as $status)
                                        <option value="{{ $status->value }}" @selected($table->status->value == $status->value)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <div class="mt-1">
                                <select name="location" id="location" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('location') border-red-400 @enderror">
                                    <option value="">Select Location</option>
                                    @foreach (App\Enums\TableLocation::cases() as $location)
                                    <option value="{{ $location->value }}" @selected($table->location->value == $location->value)>{{ $location->name }}</option>
                                    @endforeach
                                </select>
                                @error('location')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end py-3">
                            <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-0.5 mb-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
