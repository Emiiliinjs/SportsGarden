<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            ⚡ Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(Auth::user()->is_admin)

                <!-- Stats Cards -->
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex items-center gap-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">👥</div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Users</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex items-center gap-4">
                        <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">📰</div>
                        <div>
                            <p class="text-gray-500 text-sm">Rumors</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Rumor::count() }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex items-center gap-4">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">💬</div>
                        <div>
                            <p class="text-gray-500 text-sm">Comments</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Comment::count() }}</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 flex items-center gap-4">
                        <div class="p-3 bg-red-100 dark:bg-red-900 rounded-full">📈</div>
                        <div>
                            <p class="text-gray-500 text-sm">Visits (7d)</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ \App\Models\Visit::where('created_at', '>=', now()->subDays(7))->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Visits Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Visits (Last 7 Days)</h3>
                    <canvas id="visitsChart" height="100"></canvas>
                </div>

                <!-- Recent Rumors -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Latest Rumors</h3>
                    <div class="space-y-4">
                        @foreach(\App\Models\Rumor::latest()->take(5)->get() as $rumor)
                            <div class="flex justify-between items-center border-b pb-2">
                                <p class="font-semibold text-gray-700 dark:text-gray-200">{{ $rumor->title }}</p>
                                <span class="text-sm text-gray-500">{{ $rumor->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            @else
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 text-center">
                    <p class="text-lg text-gray-600 dark:text-gray-300">🚫 You don’t have access to this dashboard.</p>
                </div>
            @endif

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('visitsChart').getContext('2d');
        const visitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(
                    collect(range(6,0))->map(fn($i) => now()->subDays($i)->format('M d'))
                ) !!},
                datasets: [{
                    label: 'Visits',
                    data: {!! json_encode(
                        collect(range(6,0))->map(fn($i) => \App\Models\Visit::whereDate('created_at', now()->subDays($i))->count())
                    ) !!},
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>
