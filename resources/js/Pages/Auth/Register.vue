<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Radio, User, Mail, Lock, ArrowLeft } from 'lucide-vue-next';

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
    <!-- Wrapper Full-Screen Tema Gelap BreakLoop -->
    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col items-center justify-center p-4 relative selection:bg-emerald-500 selection:text-black">
        
        <!-- Efek Pendaran Cahaya Estetik di Latar Belakang -->
        <div class="absolute w-80 h-80 bg-purple-500/5 rounded-full filter blur-[120px] top-1/4 left-1/4 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-emerald-500/10 rounded-full filter blur-[120px] bottom-1/4 right-1/4 pointer-events-none"></div>

        <!-- Tombol Kembali ke Landing Page -->
        <Link 
            href="/" 
            class="absolute top-6 left-6 flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-white transition group"
        >
            <ArrowLeft :size="14" class="group-hover:-translate-x-1 transition-transform" />
            Back to Home
        </Link>

        <!-- KARTU FORM REGISTER (Glassmorphism Style) -->
        <div class="w-full max-w-md bg-[#111317]/80 backdrop-blur-xl border border-gray-800/80 p-8 rounded-3xl shadow-2xl shadow-black/50 z-10 my-8">
            
            <Head title="Register" />

            <!-- Header Kartu & Logo -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 text-emerald-500 font-black text-2xl tracking-wider justify-center mb-2">
                    <Radio :size="26" class="text-emerald-500 animate-pulse" />
                    BreakLoop
                </div>
                <h2 class="text-lg font-bold text-gray-200">Create Account</h2>
                <p class="text-xs text-gray-500 mt-1">Join the community and start your experience</p>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- INPUT FULL NAME -->
                <div>
                    <InputLabel for="name" value="Full Name" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="name"
                            type="text"
                            class="block w-full bg-[#181a1f] border-gray-800/80 focus:border-emerald-500/50 text-gray-200 text-sm pl-10 pr-4 py-2.5 rounded-xl transition focus:outline-none focus:ring-0"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="John Doe"
                        />
                        <User :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.name" />
                </div>

                <!-- INPUT EMAIL -->
                <div>
                    <InputLabel for="email" value="Email Address" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full bg-[#181a1f] border-gray-800/80 focus:border-emerald-500/50 text-gray-200 text-sm pl-10 pr-4 py-2.5 rounded-xl transition focus:outline-none focus:ring-0"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="name@example.com"
                        />
                        <Mail :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.email" />
                </div>

                <!-- INPUT PASSWORD -->
                <div>
                    <InputLabel for="password" value="Password" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="password"
                            type="password"
                            class="block w-full bg-[#181a1f] border-gray-800/80 focus:border-emerald-500/50 text-gray-200 text-sm pl-10 pr-4 py-2.5 rounded-xl transition focus:outline-none focus:ring-0"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <Lock :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.password" />
                </div>

                <!-- INPUT CONFIRM PASSWORD -->
                <div>
                    <InputLabel for="password_confirmation" value="Confirm Password" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="block w-full bg-[#181a1f] border-gray-800/80 focus:border-emerald-500/50 text-gray-200 text-sm pl-10 pr-4 py-2.5 rounded-xl transition focus:outline-none focus:ring-0"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <Lock :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.password_confirmation" />
                </div>

                <!-- BUTTON SUBMIT REGISTER -->
                <div class="pt-3">
                    <PrimaryButton
                        class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-bold text-sm py-3 rounded-xl justify-center shadow-lg shadow-emerald-500/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 focus:outline-none"
                        :class="{ 'opacity-50 pointer-events-none': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Creating account...</span>
                        <span v-else>Sign Up</span>
                    </PrimaryButton>
                </div>
            </form>

            <!-- FOOTER LOGIN LINK -->
            <div class="mt-6 text-center text-xs text-gray-500 border-t border-gray-900 pt-5">
                Already registered? 
                <Link :href="route('login')", class="text-emerald-400 hover:underline font-semibold ml-1">
                    Log in here
                </Link>
            </div>

        </div>
    </div>
</template>