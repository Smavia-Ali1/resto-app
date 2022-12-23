<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <a href="{{ route('admin.users.index') }}" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">View Users</a>
            </div>
            <div class="px-2 py-0.5 bg-slate-100 rounded">
                <div>User Name: {{ $user->name }}</div>
                <div>User Email: {{ $user->email }}</div>
            </div>
            <div class="bg-slate-100 rounded p-2 mt-6">
                <h2 class="text-2xl font-semibold">Roles</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @if($user->roles)
                        @foreach ($user->roles as $user_role)
                            <form action="{{ route('admin.users.roles.remove', [$user->id, $user_role] ) }}" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-2 py-2"
                                method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">{{ $user_role->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="mt-2 space-y-8 divide-y divide-gray-200 w-1/2 ">
                    <form method="POST" action="{{ route('admin.users.roles', $user->id) }}" enctype="multipart/form-data">
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
            <div class="bg-slate-100 rounded p-2 mt-6">
                <h2 class="text-2xl font-semibold">Permissions</h2>
                <div class="flex space-x-2 mt-4 p-2">
                    @if($user->permissions)
                        @foreach ($user->permissions as $user_permission)
                        <form action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission] ) }}" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-2 py-2"
                            method="POST"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">{{ $user_permission->name }}</button>
                        </form>
                        @endforeach
                    @endif
                </div>
                <div class="mt-2 space-y-8 divide-y divide-gray-200 w-1/2 ">
                    <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="permission" class="block text-sm font-medium text-gray-700"> Permission </label>
                            <select name="permission" id="permission" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('permission') border-red-400 @enderror">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
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
