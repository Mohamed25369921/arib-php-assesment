@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            {{ isset($department) ? 'Edit Department' : 'Create Department' }}
        </h1>

        <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @if(isset($department))
                @method('PUT')
            @endif

            <!-- Department Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Department Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $department->name ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ isset($department) ? 'Update Department' : 'Create Department' }}
            </button>
        </form>
    </div>
@endsection
