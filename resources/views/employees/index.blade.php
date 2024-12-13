@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Employees</h1>
        <a href="{{ route('employees.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Add Employee</a>
        
        @if($employees->isEmpty())
            <p class="text-gray-600">No employees found.</p>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Name</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Salary</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Department</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Manager</th>
                            <th class="py-3 px-6 text-center text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6">{{ $employee->user->full_name }}</td>
                                <td class="py-3 px-6">{{ $employee->salary }}</td>
                                <td class="py-3 px-6">{{ $employee->department->name }}</td>
                                <td class="py-3 px-6">
                                    {{ $employee->manager ? $employee->manager->full_name : 'N/A' }}
                                </td>
                                <td class="py-3 px-6 text-center space-x-2">
                                    <a href="{{ route('tasks.create', $employee->id) }}" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                         Assign Task
                                     </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block">
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
