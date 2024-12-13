@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
            <a href="{{ route('users.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Add New User
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="border-b text-left px-4 py-3 text-sm font-semibold text-gray-600">Name</th>
                        <th class="border-b text-left px-4 py-3 text-sm font-semibold text-gray-600">Email</th>
                        <th class="border-b text-left px-4 py-3 text-sm font-semibold text-gray-600">Role</th>
                        <th class="border-b text-left px-4 py-3 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $user->full_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                <span
                                    class="inline-block px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : ($user->role === 'manager' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
