<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, defineProps, onMounted,  } from 'vue';
import JobModal from '@/Components/JobModal.vue';
import ApplyJobModal from '@/Components/ApplyJobModal.vue'; // Import the modal


// Get jobs from the controller
const props = defineProps({
    jobs: Array
});

// Debugging
onMounted(() => {
    console.log("Received Jobs from Controller:", props.jobs);
});

// Modal state
const isModalOpen = ref(false);
const selectedJob = ref(null);
const isApplyModalOpen = ref(false);
const applyModalJob = ref(null);

// Function to open modal with job details
const openModal = (job) => {
    selectedJob.value = job;
    isModalOpen.value = true;
};

// Function to close modal
const closeModal = () => {
    isModalOpen.value = false;
    selectedJob.value = null;
};

// Function to open the modal
const openApplyModal = (job) => {
    selectedJob.value = job;
    isApplyModalOpen.value = true;
};

// Function to close the modal
const closeApplyModal = () => {
    isApplyModalOpen.value = false;
    applyModalJob.value = null;
};

// Filters
const selectedTitle = ref('');
const selectedLocation = ref('');
const salaryRange = ref([30000, 200000]);

// Extract unique job titles and locations from jobs
const jobTitles = computed(() => {
    const uniqueTitles = new Set(props.jobs.map(job => job.title).filter(Boolean));
    return Array.from(uniqueTitles);
});

const locations = computed(() => {
    const uniqueLocations = new Set(props.jobs.map(job => job.location).filter(Boolean));
    return Array.from(uniqueLocations);
});

// Filtered jobs list
const filteredJobs = computed(() => {
    return props.jobs.filter(job => {
        const matchesTitle = selectedTitle.value ? job.title === selectedTitle.value : true;
        const matchesLocation = selectedLocation.value ? job.location === selectedLocation.value : true;
        const matchesSalary = job.salary_min >= salaryRange.value[0] && job.salary_min <= salaryRange.value[1];

        return matchesTitle && matchesLocation && matchesSalary;
    });
});

const errorMessage = ref('');
const successMessage = ref('');

onMounted(() => {
    errorMessage.value = sessionStorage.getItem('error') || '';
    successMessage.value = sessionStorage.getItem('success') || '';

    // Clear messages after displaying
    sessionStorage.removeItem('error');
    sessionStorage.removeItem('success');
});
</script>

<template>
    <AuthenticatedLayout>
        <div>
        <div v-if="errorMessage" class="bg-red-500 text-white p-3 rounded mb-4">
            {{ errorMessage }}
        </div>
        <div v-if="successMessage" class="bg-green-500 text-white p-3 rounded mb-4">
            {{ successMessage }}
        </div>
    </div>
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar Filters -->
            <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filters</h3>

                <!-- Job Title Filter -->
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Job Title</label>
                    <select v-model="selectedTitle" class="w-full p-2 border rounded-lg mt-1">
                        <option value="">All Titles</option>
                        <option v-for="title in jobTitles" :key="title">{{ title }}</option>
                    </select>
                </div>

                <!-- Location Filter -->
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Location</label>
                    <select v-model="selectedLocation" class="w-full p-2 border rounded-lg mt-1">
                        <option value="">All Locations</option>
                        <option v-for="location in locations" :key="location">{{ location }}</option>
                    </select>
                </div>

                <!-- Salary Range Filter -->
                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Salary Range</label>
                    <input type="range" v-model="salaryRange[0]" min="30000" max="200000" step="5000" class="w-full mt-1">
                    <input type="range" v-model="salaryRange[1]" min="30000" max="200000" step="5000" class="w-full">
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        From ${{ salaryRange[0].toLocaleString() }} to ${{ salaryRange[1].toLocaleString() }}
                    </p>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">🚀 Job Listings</h3>

                    <div v-if="filteredJobs.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div v-for="job in filteredJobs" :key="job.id"
                            class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                            
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ job.title }}</h4>
                            <p class="text-gray-600 dark:text-gray-400">{{ job.company }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ job.location }}</p>
                            <p class="text-green-600 font-semibold">${{ job.salary_min ? job.salary_min.toLocaleString()  : 'N/A' }}/year</p>

                            <!-- Links -->
                            <div class="mt-4 flex justify-between">
                                <button @click="openModal(job)"
                                    class="px-4 py-2 text-blue-600 border border-blue-500 font-medium rounded-lg hover:bg-blue-600 hover:text-white transition duration-300">
                                    View Details
                                </button>
                                <button @click="openApplyModal(job)"
                                    class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition duration-300">
                                    Apply Now
                                </button>
                            </div>
                        </div>  
                    </div>

                    <p v-else class="text-gray-600 dark:text-gray-400 text-center py-6">🚫 No jobs found matching your filters.</p>

                    <pre>{{ props.job }}</pre>
                </div>
            </main>
        </div>
        <JobModal v-if="isModalOpen" :job="selectedJob" :isOpen="isModalOpen" @close="closeModal" />
        <ApplyJobModal v-if="isApplyModalOpen" :job="selectedJob" :isOpen="isApplyModalOpen" @close="closeApplyModal" />
    </AuthenticatedLayout>
</template>
