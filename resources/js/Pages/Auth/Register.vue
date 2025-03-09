<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="flex min-h-screen items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">
            <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                
                <!-- Header -->
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Create an Account</h2>
                    <p class="text-gray-500 dark:text-gray-300 mt-1">Join our job portal today</p>
                </div>

                <!-- Registration Form -->
                <form @submit.prevent="submit">
                    
                    <!-- Name -->
                    <div>
                        <InputLabel for="name" value="Full Name" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                👤
                            </span>
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full pl-10"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <InputLabel for="email" value="Email Address" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                📧
                            </span>
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full pl-10"
                                v-model="form.email"
                                required
                                autocomplete="username"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                🔒
                            </span>
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full pl-10"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                🔑
                            </span>
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full pl-10"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Register Button -->
                    <div class="mt-6">
                        <PrimaryButton
                            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </PrimaryButton>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Already have an account? 
                    <Link :href="route('login')" class="text-blue-600 hover:underline dark:text-blue-400">
                        Log in
                    </Link>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
