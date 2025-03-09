<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    applications: Array
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Applied Jobs</h1>
            <p class="text-gray-600 dark:text-gray-300">Here are the jobs you have applied for:</p>

            <div v-if="applications.length" class="mt-6 space-y-4">
                <div v-for="application in applications" :key="application.id"
                    class="p-4 border rounded-lg dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ application.job_post?.title }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ application.job_post?.company }}</p>
                    <p class="text-gray-600 dark:text-gray-300">{{ application.job_post?.location }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Status: <span class="font-semibold">{{ application.status }}</span>
                    </p>
                </div>
            </div>

            <p v-else class="text-gray-500 dark:text-gray-400 mt-4">You haven't applied for any jobs yet.</p>
        </div>
    </AuthenticatedLayout>
</template>
