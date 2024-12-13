@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Assign Task to {{ $employee->user->full_name }}</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <input type="hidden" name="employee_id" value="{{ $employee->id }}">

            <!-- Task Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Task Title</label>
                <input type="text" id="title" name="title" 
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>

            <!-- Task Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                <textarea id="description" name="description" 
                          class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                          rows="4"></textarea>
            </div>

            <!-- Task Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Task Status</label>
                <select id="status" name="status" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Assign Task
            </button>
        </form>
    </div>
@endsection
