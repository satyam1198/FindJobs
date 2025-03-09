<!-- JobModal.vue -->
<script setup>
import { defineProps, defineEmits } from 'vue';

// Receive job details
const props = defineProps({
    job: Object,
    isOpen: Boolean
});

// Emit event to close modal
const emit = defineEmits(['close']);
</script>

<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg w-full relative max-h-[90vh] overflow-hidden">
            <!-- Close Button -->
            <button @click="emit('close')" class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-red-500">
                ✖
            </button>

            <!-- Scrollable Content -->
            <div class="overflow-y-auto max-h-[75vh] pr-2">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ job?.title }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ job?.company }}</p>
                <p class="text-gray-600 dark:text-gray-300">{{ job?.location }}</p>
                <p class="text-green-600 font-semibold">${{ job?.salary_min ? job.salary_min.toLocaleString() : 'N/A' }}/year</p>

                <hr class="my-4">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Job Description</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ job?.description || 'No description provided.' }}</p>

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Roles & Responsibilities</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ job.responsibilities || 'No description provided.' }}</p>

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Perks</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ job.perks || 'No description provided.' }}</p>

                <hr class="my-4">

                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Us</h3>
                <p class="text-gray-700 dark:text-gray-300">🌐 <a :href="job.website" target="_blank" class="text-blue-500 underline">{{ job.website || 'No website provided.' }}</a></p>
                <p class="text-gray-700 dark:text-gray-300">📧 {{ job.contact_email || 'No email provided.' }}</p>

                <!-- Apply Button -->
                <div class="mt-6">
                    <a :href="`/jobs/${job.id}/apply`"
                        class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition duration-300">
                        Apply Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
