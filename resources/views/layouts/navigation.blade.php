<nav class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-white text-xl font-bold">MyApp</a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-6">
                @auth
                    @if(auth()->user()->role === 'manager')
                        <a href="{{ route('employees.index') }}" class="text-white hover:text-blue-300">Employees</a>
                        <a href="{{ route('departments.index') }}" class="text-white hover:text-blue-300">Departments</a>
                    @elseif(auth()->user()->role === 'employee')
                        <a href="{{ route('tasks.index') }}" class="text-white hover:text-blue-300">Tasks</a>
                    @endif
                @endauth
            </div>

            <!-- User Profile/Logout -->
            @auth
                <div class="flex items-center space-x-4">
                    <a href="{{ route('profile.edit') }}" class="text-white hover:text-blue-300">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-red-300">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
