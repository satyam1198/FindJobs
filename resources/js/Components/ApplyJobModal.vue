<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Receive job details & modal state
const props = defineProps({
    job: Object,
    isOpen: Boolean
});

// Emit event to close modal
const emit = defineEmits(['close']);

// Inertia form setup
const form = useForm({
    name: '',
    email: '',
    resume: null,
    cover_letter: '',
    job_id: props.job?.id
});

// Handle file upload
const handleFileUpload = (event) => {
    form.resume = event.target.files[0]; // Attach file to form
};

// Submit application
const applyForJob = () => {
    form.post(route('apply.job'), {
        onFinish: () => {
            if (!form.hasErrors) {
                form.reset(); // Reset form after successful submission
                emit('close'); // Close modal
            }
        }
    });
};
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
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Apply for {{ job?.title }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ job?.company }} - {{ job?.location }}</p>
                <hr class="my-4">

                <!-- Error Messages -->
                <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
                <p v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</p>
                <p v-if="form.errors.resume" class="text-red-500">{{ form.errors.resume }}</p>

                <!-- Form -->
                <form @submit.prevent="applyForJob" class="space-y-4">
                    <input type="hidden" v-model="form.job_id" />

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Full Name:</label>
                        <input type="text" v-model="form.name"
                            class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Email:</label>
                        <input type="email" v-model="form.email"
                            class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Upload Resume (PDF):</label>
                        <input type="file" accept=".pdf" @change="handleFileUpload"
                            class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white" required />
                    </div>

                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Cover Letter (Optional):</label>
                        <textarea v-model="form.cover_letter" rows="3"
                            class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-white"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition duration-300"
                        :disabled="form.processing">
                        {{ form.processing ? 'Submitting...' : 'Submit Application' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
