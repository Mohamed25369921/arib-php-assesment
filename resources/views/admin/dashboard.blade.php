@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Users Card -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4m12 2v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0a6 6 0 00-12 0"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-700">Users</h2>
                <p class="text-sm text-gray-500">Total: {{ $userCount }}</p>
                <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">Manage Users</a>
            </div>
        </div>

        <!-- Departments Card -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 16.5l-3.375 3.375a4.5 4.5 0 01-6.375 0l-3.375-3.375a4.5 4.5 0 010-6.375L3.375 6.75a4.5 4.5 0 016.375 0l3.375 3.375m12.75-3.75L15.375 12a4.5 4.5 0 000 6.375l3.375 3.375a4.5 4.5 0 006.375 0l3.375-3.375a4.5 4.5 0 000-6.375L21.75 6.75a4.5 4.5 0 00-6.375 0L12 9.75"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-700">Departments</h2>
                <p class="text-sm text-gray-500">Total: {{ $departmentCount }}</p>
                <a href="{{ route('departments.index') }}" class="text-green-600 hover:underline">Manage Departments</a>
            </div>
        </div>

        <!-- Tasks Card -->
        <div class="bg-white shadow rounded-lg p-4 flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-semibold text-gray-700">Tasks</h2>
                <p class="text-sm text-gray-500">Total: {{ $taskCount }}</p>
                <a href="{{ route('tasks.index') }}" class="text-yellow-600 hover:underline">Manage Tasks</a>
            </div>
        </div>
    </div>

    <!-- Actions Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('users.create') }}" class="bg-blue-600 text-white p-4 rounded-lg text-center shadow hover:bg-blue-700">
                Add User
            </a>
            <a href="{{ route('departments.create') }}" class="bg-green-600 text-white p-4 rounded-lg text-center shadow hover:bg-green-700">
                Add Department
            </a>
            <a href="{{ route('tasks.assign') }}" class="bg-yellow-600 text-white p-4 rounded-lg text-center shadow hover:bg-yellow-700">
                Add Task
            </a>
        </div>
    </div>
</div>
@endsection
