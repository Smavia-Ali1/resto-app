<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <a href="{{ route('admin.reservation.create') }}" class="text-white bg-purple-700 hover:bg-purple-800 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Add Reservation</a>
            </div>
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                               Email
                            </th>
                             <th scope="col" class="py-3 px-6">
                                Reservation Date
                             </th>
                             <th scope="col" class="py-3 px-6">
                                Table
                             </th>
                             <th scope="col" class="py-3 px-6">
                                Guest No.
                             </th>
                             <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->id }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $reservation->first_name }} {{ $reservation->last_name}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reservation->email}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reservation->res_date}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reservation->table->name}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reservation->guest_number}}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.reservation.edit', $reservation->id) }}" class="text-white bg-green-600 hover:bg-green-700 rounded-lg text-sm px-2 py-2">Edit</a>
                                    <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" class="text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm px-2 py-2"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-admin-layout>

