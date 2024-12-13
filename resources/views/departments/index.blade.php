@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Departments</h1>
        <a href="{{ route('departments.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Add Department</a>

        @if($departments->isEmpty())
            <p class="text-gray-600">No departments found.</p>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Name</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Employee Count</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Total Salaries</th>
                            <th class="py-3 px-6 text-center text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6">{{ $department->name }}</td>
                                <td class="py-3 px-6">{{ $department->employees_count }}</td>
                                <td class="py-3 px-6">{{ $department->employees_sum_salary }}</td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <a href="{{ route('departments.edit', $department->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
