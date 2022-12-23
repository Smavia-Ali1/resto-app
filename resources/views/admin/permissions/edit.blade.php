<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <a href="{{ route('admin.permissions.index') }}" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">View Permissions</a>
            </div>
            <div class="px-2 py-0.5 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.permissions.update', $permission->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name* </label>
                            <div class="mt-1">
                                <input type="text" id="name" value="{{ $permission->name }}" wire:model.lazy="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-400 @enderror"/>
                                @error('name')
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-100 rounded p-2 mt-6">
                <h2 class="text-2xl font-semibold">Roles</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @if($permission->roles)
                        @foreach ($permission->roles as $permission_role)
                        <form action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role] ) }}" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-2 py-2"
                            method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">{{ $permission_role->name }}</button>
                        </form>
                        @endforeach
                    @endif
                </div>
                <div class="mt-2 space-y-8 divide-y divide-gray-200 w-1/2 ">
                    <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="role" class="block text-sm font-medium text-gray-700"> Roles </label>
                            <select name="role" id="role" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('role') border-red-400 @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex justify-end py-3">
                            <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-0.5 mb-2">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
