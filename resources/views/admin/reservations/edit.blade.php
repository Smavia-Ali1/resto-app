<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <a href="{{ route('admin.reservation.index') }}" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">View Reservations</a>
            </div>
            <div class="px-2 py-0.5 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.reservation.update', $reservation->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name* </label>
                            <div class="mt-1">
                                <input type="text" id="first_name" value="{{ $reservation->first_name }}" wire:model.lazy="first_name" name="first_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') border-red-400 @enderror"/>
                                @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name* </label>
                            <div class="mt-1">
                                <input type="text" id="last_name" value="{{ $reservation->last_name }}" wire:model.lazy="last_name" name="last_name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') border-red-400 @enderror"/>
                                @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="email" class="block text-sm font-medium text-gray-700"> Email* </label>
                            <div class="mt-1">
                                <input type="email" id="email" value="{{ $reservation->email }}" wire:model.lazy="email" name="email" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-400 @enderror"/>
                                @error('email')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="tel_number" class="block text-sm font-medium text-gray-700"> Phone Number* </label>
                            <div class="mt-1">
                                <input type="text" id="tel_number" value="{{ $reservation->tel_number }}" wire:model.lazy="tel_number" name="tel_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('tel_number') border-red-400 @enderror"/>
                                @error('tel_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="res_date" class="block text-sm font-medium text-gray-700"> Reservation Date* </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="res_date" value="{{ $reservation->res_date }}" wire:model.lazy="res_date" name="res_date" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('res_date') border-red-400 @enderror"/>
                                @error('res_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number* </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" value="{{ $reservation->guest_number }}" wire:model.lazy="guest_number" name="guest_number" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('guest_number') border-red-400 @enderror"/>
                                @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                            <div class="mt-1">
                                <select name="table_id" id="table_id" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('table_id') border-red-400 @enderror">
                                    <option value="">Select Table</option>
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}" @selected($table->name)>{{ $table->name }}({{ $table->guest_number }} Guests)</option>
                                    @endforeach
                                </select>
                                @error('table_id')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end py-3">
                            <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-0.5 mb-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
