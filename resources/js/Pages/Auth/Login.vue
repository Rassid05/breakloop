<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Radio, Lock, Mail, ArrowLeft } from 'lucide-vue-next';

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
    <!-- Kita bungkus di dalam wrapper full-screen gelap bawaan tema BreakLoop -->
    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col items-center justify-center p-4 relative selection:bg-emerald-500 selection:text-black">
        
        <!-- Efek Pendaran Cahaya Estetik di Latar Belakang -->
        <div class="absolute w-80 h-80 bg-emerald-500/10 rounded-full filter blur-[120px] top-1/4 left-1/4 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-purple-500/5 rounded-full filter blur-[120px] bottom-1/4 right-1/4 pointer-events-none"></div>

        <!-- Tombol Kembali ke Landing Page -->
        <Link 
            href="/" 
            class="absolute top-6 left-6 flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-white transition group"
        >
            <ArrowLeft :size="14" class="group-hover:-translate-x-1 transition-transform" />
            Back to Home
        </Link>

        <!-- KARTU FORM LOGIN (Glassmorphism Style) -->
        <div class="w-full max-w-md bg-[#111317]/80 backdrop-blur-xl border border-gray-800/80 p-8 rounded-3xl shadow-2xl shadow-black/50 z-10">
            
            <Head title="Log in" />

            <!-- Header Kartu & Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 text-emerald-500 font-black text-2xl tracking-wider justify-center mb-2">
                    <Radio :size="26" class="text-emerald-500 animate-pulse" />
                    BreakLoop
                </div>
                <h2 class="text-lg font-bold text-gray-200">Welcome Back</h2>
                <p class="text-xs text-gray-500 mt-1">Log in to continue your music loop</p>
            </div>

            <!-- Status Alert Bawaan Laravel -->
            <div v-if="status" class="mb-4 text-xs font-medium text-emerald-400 bg-emerald-950/30 border border-emerald-900/50 p-3 rounded-xl">
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-5">
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
                            autofocus
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
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />
                        <Lock :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.password" />
                </div>

                <!-- REMEMBER ME & FORGOT PASSWORD -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center cursor-pointer select-none group">
                        <Checkbox 
                            name="remember" 
                            v-model:checked="form.remember" 
                            class="rounded bg-[#181a1f] border-gray-800 text-emerald-500 focus:ring-0 focus:ring-offset-0"
                        />
                        <span class="ms-2 text-gray-400 group-hover:text-gray-200 transition">Remember me</span>
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-gray-500 hover:text-emerald-400 font-medium transition"
                    >
                        Forgot password?
                    </Link>
                </div>

                <!-- BUTTON SUBMIT LOGIN -->
                <div class="pt-2">
                    <PrimaryButton
                        class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-bold text-sm py-3 rounded-xl justify-center shadow-lg shadow-emerald-500/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 focus:outline-none"
                        :class="{ 'opacity-50 pointer-events-none': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Logging in...</span>
                        <span v-else>Log In</span>
                    </PrimaryButton>
                </div>
            </form>

            <!-- FOOTER REGISTER LINK -->
            <div class="mt-6 text-center text-xs text-gray-500 border-t border-gray-900 pt-5">
                Don't have an account? 
                <Link :href="route('register')" class="text-emerald-400 hover:underline font-semibold ml-1">
                    Sign up for free
                </Link>
            </div>

        </div>
    </div>
</template>