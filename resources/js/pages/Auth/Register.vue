<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

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

        <!-- Title -->
        <div class="mb-8 text-center">
            <h2 class="mb-2 text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="text-gray-600">Daftar untuk mengakses semua fitur</p>
        </div>

        <form @submit.prevent="submit" class="space-y-5">
            <div>
                <InputLabel for="name" value="Nama Lengkap" class="font-semibold text-gray-700" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap Anda"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" class="font-semibold text-gray-700" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.email"
                    required
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
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Konfirmasi Password" class="font-semibold text-gray-700" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password Anda"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="pt-2">
                <PrimaryButton
                    class="w-full transform justify-center rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] hover:from-blue-700 hover:to-cyan-700"
                    :class="{ 'cursor-not-allowed opacity-50': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="!form.processing">Daftar</span>
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
                    Sudah punya akun?
                    <Link :href="route('login')" class="ml-1 font-semibold text-blue-600 transition-colors hover:text-blue-700"> Masuk di sini </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
