@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">My Tasks</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->isEmpty())
            <div class="text-center text-gray-600">
                <p>No tasks assigned yet.</p>
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Title</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Description</th>
                            <th class="py-3 px-6 text-left text-gray-600 font-semibold">Status</th>
                            <th class="py-3 px-6 text-center text-gray-600 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-6">{{ $task->title }}</td>
                                <td class="py-3 px-6 text-gray-600">{{ $task->description }}</td>
                                <td class="py-3 px-6">
                                    <span class="px-2 py-1 text-sm rounded-lg 
                                        {{ $task->status === 'completed' ? 'bg-green-100 text-green-600' : ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($task->status !== 'completed')
                                        <form action="{{ route('tasks.update.status', $task->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="{{ $task->status === 'pending' ? 'in_progress' : 'completed' }}">
                                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                                                {{ $task->status === 'pending' ? 'Start' : 'Complete' }}
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-sm">No actions</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
