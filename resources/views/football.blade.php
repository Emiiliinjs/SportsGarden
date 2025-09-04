@extends('layouts.app') <!-- Optional if you have a layout, otherwise remove -->

@section('content')
<div class="bg-gray-100 min-h-screen">

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-64" style="background-image: url('https://source.unsplash.com/1600x400/?football,stadium')">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white">Football News</h1>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-10">Top Football Headlines</h2>

            <div class="grid gap-8 md:grid-cols-3">

                <!-- Example Card 1 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?football,match" alt="Football Match" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Exciting Match Tonight</h3>
                        <p class="text-gray-600 mb-4">Top teams are facing off in a thrilling football match under the lights.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>

                <!-- Example Card 2 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?football,training" alt="Football Training" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Team Training Updates</h3>
                        <p class="text-gray-600 mb-4">Check out the latest training sessions and strategies for upcoming matches.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>

                <!-- Example Card 3 -->
                <div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden">
                    <img src="https://source.unsplash.com/400x250/?football,trophy" alt="Football Trophy" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2">Championship Highlights</h3>
                        <p class="text-gray-600 mb-4">Recap of recent championship matches and the players who made it memorable.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Read More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-700 text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} SportNews. All rights reserved.</p>
        </div>
    </footer>

</div>
@endsection
