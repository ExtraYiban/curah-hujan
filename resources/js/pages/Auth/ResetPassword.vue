<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <!-- Title -->
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    ></path>
                </svg>
            </div>
            <h2 class="mb-2 text-3xl font-bold text-gray-900">Reset Password</h2>
            <p class="text-gray-600">Masukkan password baru Anda</p>
        </div>

        <form @submit.prevent="submit" class="space-y-5">
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
                <InputLabel for="password" value="Password Baru" class="font-semibold text-gray-700" />

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
                <InputLabel for="password_confirmation" value="Konfirmasi Password Baru" class="font-semibold text-gray-700" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-transparent focus:ring-2 focus:ring-blue-500"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Ulangi password baru Anda"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="pt-2">
                <PrimaryButton
                    class="w-full transform justify-center rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 py-3 font-semibold text-white shadow-lg transition-all duration-200 hover:scale-[1.02] hover:from-blue-700 hover:to-cyan-700"
                    :class="{ 'cursor-not-allowed opacity-50': form.processing }"
                    :disabled="form.processing"
                >
                    <span v-if="!form.processing">Reset Password</span>
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
        </form>
    </GuestLayout>
</template>
