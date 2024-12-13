@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Select an Employee</h1>

        <table class="w-full border-collapse bg-white shadow rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2 text-left">Name</th>
                    <th class="border px-4 py-2 text-left">Email</th>
                    <th class="border px-4 py-2 text-left">Department</th>
                    <th class="border px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $employee->user->full_name }}</td>
                        <td class="border px-4 py-2">{{ $employee->user->email }}</td>
                        <td class="border px-4 py-2">{{ $employee->department->name ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('tasks.create', $employee->id) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Assign Task
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
