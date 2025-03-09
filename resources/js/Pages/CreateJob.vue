<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    title: '',
    company: '',
    location: '',
    job_type: 'Full-time',
    salary_min: 50000,
    salary_max: 120000,
    description: '',
    responsibilities: '',
    requirements: '',
    perks: '',
    application_deadline: '',
    contact_email: '',
    website: '',
});



// Salary range
const salaryMin = ref(50000);
const salaryMax = ref(120000);

// Job types
const jobTypes = ['Full-time', 'Part-time', 'Contract', 'Remote', 'Internship'];

// Submit function
const submit = () => {
    form.post(route('jobs.store'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Post a Job" />

        <div class="max-w-6xl mx-auto p-6">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Post a Job</h2>

                <form @submit.prevent="submit">
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Job Title -->
                        <div>
                            <InputLabel for="title" value="Job Title" />
                            <TextInput id="title" v-model="form.title" required class="w-full" />
                            <InputError :message="form.errors.title" />
                        </div>

                        <!-- Company Name -->
                        <div>
                            <InputLabel for="company" value="Company Name" />
                            <TextInput id="company" v-model="form.company" required class="w-full" />
                            <InputError :message="form.errors.company" />
                        </div>

                        <!-- Location -->
                        <div>
                            <InputLabel for="location" value="Location" />
                            <TextInput id="location" v-model="form.location" required class="w-full" />
                            <InputError :message="form.errors.location" />
                        </div>

                        <!-- Job Type -->
                        <div>
                            <InputLabel for="job_type" value="Job Type" />
                            <select id="job_type" v-model="form.job_type" required class="w-full border-gray-300 rounded-md p-2">
                                <option v-for="type in jobTypes" :key="type">{{ type }}</option>
                            </select>
                            <InputError :message="form.errors.job_type" />
                        </div>
                    </div>

                    <!-- Salary & Compensation -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Salary Range</h3>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="salary_min" value="Min Salary ($)" />
                                <TextInput id="salary_min" v-model="form.salary_min" required type="number" class="w-full" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="salary_max" value="Max Salary ($)" />
                                <TextInput id="salary_max" v-model="form.salary_max" required type="number" class="w-full" />
                            </div>
                        </div>
                        <InputError :message="form.errors.salary_min || form.errors.salary_max" />
                    </div>

                    <!-- Job Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Job Description</h3>
                        <textarea v-model="form.description" required class="w-full border-gray-300 rounded-md p-3 h-32" placeholder="Describe the job role and expectations..."></textarea>
                        <InputError :message="form.errors.description" />
                    </div>

                    <!-- Responsibilities -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Responsibilities</h3>
                        <textarea v-model="form.responsibilities" required class="w-full border-gray-300 rounded-md p-3 h-32" placeholder="List job responsibilities..."></textarea>
                        <InputError :message="form.errors.responsibilities" />
                    </div>

                    <!-- Requirements -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Requirements</h3>
                        <textarea v-model="form.requirements" required class="w-full border-gray-300 rounded-md p-3 h-32" placeholder="List job requirements..."></textarea>
                        <InputError :message="form.errors.requirements" />
                    </div>

                    <!-- Perks & Benefits -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Perks & Benefits</h3>
                        <textarea v-model="form.perks" class="w-full border-gray-300 rounded-md p-3 h-32" placeholder="List any perks or benefits..."></textarea>
                        <InputError :message="form.errors.perks" />
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <InputLabel for="application_deadline" value="Application Deadline" />
                            <TextInput id="application_deadline" v-model="form.application_deadline" required type="date" class="w-full" />
                            <InputError :message="form.errors.application_deadline" />
                        </div>

                        <div>
                            <InputLabel for="contact_email" value="Contact Email" />
                            <TextInput id="contact_email" v-model="form.contact_email" required type="email" class="w-full" />
                            <InputError :message="form.errors.contact_email" />
                        </div>
                    </div>

                    <!-- Company Website -->
                    <div class="mt-6">
                        <InputLabel for="website" value="Company Website (Optional)" />
                        <TextInput id="website" v-model="form.website" type="url" class="w-full" placeholder="https://company.com" />
                        <InputError :message="form.errors.website" />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <PrimaryButton :disabled="form.processing">Post Job</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
