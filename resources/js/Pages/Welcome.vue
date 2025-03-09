<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Find Your Dream Job" />

    <div class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white">
        <!-- Hero Section -->
        <div class="relative bg-cover bg-center h-screen flex items-center justify-center" 
             style="background-image: url('https://source.unsplash.com/1600x900/?office,team');">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            
            <div class="relative z-10 text-center max-w-2xl px-6">
                <h1 class="text-4xl font-extrabold text-white md:text-6xl">
                    Find Your <span class="text-yellow-400">Dream Job</span> Today
                </h1>
                <p class="mt-4 text-lg text-gray-200">
                    The best job opportunities from top companies worldwide.
                </p>

                <!-- Search Bar -->
                <div class="mt-6 flex justify-center">
                    <input type="text" placeholder="Search jobs..." 
                           class="w-full md:w-96 px-4 py-3 rounded-l-md text-gray-900 border-none focus:ring-2 focus:ring-yellow-400">
                    <button class="bg-yellow-500 hover:bg-yellow-600 px-6 py-3 rounded-r-md text-white font-semibold">
                        Search
                    </button>
                </div>

                <!-- CTA Buttons -->
                <div class="mt-6 flex justify-center space-x-4">
                    <Link v-if="canLogin" :href="route('login')" 
                          class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-md text-white font-semibold">
                        Log in
                    </Link>
                    
                    <Link v-if="canRegister" :href="route('register')" 
                          class="bg-green-600 hover:bg-green-700 px-6 py-3 rounded-md text-white font-semibold">
                        Register
                    </Link>
                </div>
            </div>
        </div>

        <!-- Featured Jobs Section -->
        <div class="py-16 bg-white dark:bg-gray-800">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Featured Jobs</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Explore the top job listings</p>

                <!-- Placeholder for job listings -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold">Software Engineer</h3>
                        <p class="text-gray-600 dark:text-gray-300">Google - New York</p>
                        <Link href="#" class="text-blue-500 hover:underline mt-2 inline-block">Apply Now</Link>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold">Product Manager</h3>
                        <p class="text-gray-600 dark:text-gray-300">Amazon - Seattle</p>
                        <Link href="#" class="text-blue-500 hover:underline mt-2 inline-block">Apply Now</Link>
                    </div>

                    <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold">Data Analyst</h3>
                        <p class="text-gray-600 dark:text-gray-300">Microsoft - San Francisco</p>
                        <Link href="#" class="text-blue-500 hover:underline mt-2 inline-block">Apply Now</Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-6 text-center">
            <p>&copy; 2025 JobPortal. All rights reserved.</p>
        </footer>
    </div>
</template>
