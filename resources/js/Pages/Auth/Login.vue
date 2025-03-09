<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="flex min-h-screen items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">
            <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                
                <!-- Header -->
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome Back</h2>
                    <p class="text-gray-500 dark:text-gray-300 mt-1">Login to your account</p>
                </div>

                <!-- Status Message -->
                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <!-- Login Form -->
                <form @submit.prevent="submit">
                    
                    <!-- Email Input -->
                    <div>
                        <InputLabel for="email" value="Email" />
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
                                autofocus
                                autocomplete="username"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password Input -->
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
                                autocomplete="current-password"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-4 flex items-center justify-between">
                        <label class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-2">Remember me</span>
                        </label>

                        <!-- Forgot Password -->
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-sm text-blue-600 hover:underline dark:text-blue-400"
                        >
                            Forgot Password?
                        </Link>
                    </div>

                    <!-- Login Button -->
                    <div class="mt-6">
                        <PrimaryButton
                            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Log in
                        </PrimaryButton>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account? 
                    <Link :href="route('register')" class="text-blue-600 hover:underline dark:text-blue-400">
                        Sign up
                    </Link>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
