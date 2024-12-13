@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-lg p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="first_name" name="first_name" 
                       value="{{ old('first_name', $user->first_name ?? '') }}"
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>
            
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="last_name" name="last_name" 
                       value="{{ old('last_name', $user->last_name ?? '') }}"
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                       required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter Email" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password"
                       class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter Password">
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        required>
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Manager</option>
                    <option value="employee" {{ $user->hasRole('employee') ? 'selected' : '' }}>Employee</option>
                </select>
            </div>

            <!-- Employee-Specific Fields -->
            <div id="employee-fields" style="display: {{ $user->hasRole('employee') ? 'block' : 'none' }}">
                <!-- Salary -->
                <div class="mb-4">
                    <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                    <input type="number" id="salary" name="salary" value="{{ old('salary', optional($user->employee)->salary) }}"
                           class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter Salary">
                </div>

                <!-- Department -->
                <div class="mb-4">
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                    <select id="department_id" name="department_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                    {{ old('department_id', optional($user->employee)->department_id) == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Manager -->
                <div class="mb-4">
                    <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager</label>
                    <select id="manager_id" name="manager_id"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Manager</option>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}"
                                    {{ old('manager_id', optional($user->employee)->manager_id) == $manager->id ? 'selected' : '' }}>
                                {{ $manager->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                Update User
            </button>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleField = document.getElementById('role');
        const employeeFields = document.getElementById('employee-fields');

        function toggleEmployeeFields() {
            employeeFields.style.display = roleField.value === 'employee' ? 'block' : 'none';
        }

        toggleEmployeeFields();
        roleField.addEventListener('change', toggleEmployeeFields);
    });
</script>
