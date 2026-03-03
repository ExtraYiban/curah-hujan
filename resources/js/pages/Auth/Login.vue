<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

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
        <Head title="Login" />

        <!-- Title -->
        <div class="mb-8 text-center">
            <h2 class="mb-2 text-3xl font-bold text-gray-900">Selamat Datang Kembali</h2>
            <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <div v-if="status" class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4">
            <p class="text-sm font-medium text-green-800">{{ status }}</p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <InputLabel for="email" value="Email" class="font-semibold text-gray-700" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="nama@email.com"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Password" class="font-semibold text-gray-700" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password Anda"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex cursor-pointer items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm font-medium text-gray-600">Ingat saya</span>
                </label>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm font-medium text-blue-600 transition-colors hover:text-blue-700"
                >
                    Lupa password?
                </Link>
            </div>

            <div>
                <PrimaryButton
                    class="w-full transform justify-center rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] hover:from-blue-700 hover:to-cyan-700"
                    :class="{ 'cursor-not-allowed opacity-50': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="!form.processing">Masuk</span>
                    <span v-else class="flex items-center gap-2">
                        <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                        Memproses...
                    </span>
                </PrimaryButton>
            </div>

            <div class="border-t border-gray-200 pt-4 text-center">
                <p class="text-gray-600">
                    Belum punya akun?
                    <Link :href="route('register')" class="ml-1 font-semibold text-blue-600 transition-colors hover:text-blue-700">
                        Daftar sekarang
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
