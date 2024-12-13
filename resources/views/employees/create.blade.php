@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($employee) ? 'Edit Employee' : 'Add New Employee' }}</h1>

    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        <!-- First Name -->
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="first_name" name="first_name"
                value="{{ old('first_name', $employee->user->first_name ?? '') }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter First Name" required>
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="last_name" name="last_name"
                value="{{ old('last_name', $employee->user->last_name ?? '') }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Last Name" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                value="{{ old('email', $employee->user->email ?? '') }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Email" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Password" {{ isset($employee) ? '' : 'required' }}>
        </div>

        <!-- Salary -->
        <div class="mb-4">
            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
            <input type="number" id="salary" name="salary"
                value="{{ old('salary', $employee->salary ?? '') }}"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter Salary" required>
        </div>

        <!-- Department -->
        <div class="mb-4">
            <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
            <select id="department_id" name="department_id"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id',$employee->department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>

        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
            {{ isset($employee) ? 'Update Employee' : 'Add Employee' }}
        </button>
    </form>
</div>
@endsection
