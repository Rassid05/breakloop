<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Radio, Mail, KeyRound, ArrowLeft } from 'lucide-vue-next';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col items-center justify-center p-4 relative selection:bg-emerald-500 selection:text-black">
        
        <div class="absolute w-80 h-80 bg-emerald-500/5 rounded-full filter blur-[120px] top-1/4 left-1/4 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-purple-500/5 rounded-full filter blur-[120px] bottom-1/4 right-1/4 pointer-events-none"></div>

        <Link 
            :href="route('login')" 
            class="absolute top-6 left-6 flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-white transition group"
        >
            <ArrowLeft :size="14" class="group-hover:-translate-x-1 transition-transform" />
            Back to Log In
        </Link>

        <div class="w-full max-w-md bg-[#111317]/80 backdrop-blur-xl border border-gray-800/80 p-8 rounded-3xl shadow-2xl shadow-black/50 z-10">
            
            <Head title="Forgot Password" />

            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 text-emerald-500 font-black text-2xl tracking-wider justify-center mb-6">
                    <Radio :size="26" class="text-emerald-500 animate-pulse" />
                    BreakLoop
                </div>
                
                <div class="w-14 h-14 bg-[#181a1f] border border-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-3 text-gray-400">
                    <KeyRound :size="24" class="text-emerald-400" />
                </div>
                
                <h2 class="text-lg font-bold text-gray-200">Forgot Password?</h2>
            </div>

            <div class="mb-5 text-xs text-gray-400 text-center leading-relaxed">
                No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <div
                v-if="status"
                class="mb-5 text-xs font-medium text-emerald-400 bg-emerald-950/30 border border-emerald-900/50 p-3 rounded-xl text-center"
            >
                {{ status }}
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <InputLabel id="email-label" for="email" value="Email Address" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

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

                <div class="pt-2">
                    <PrimaryButton
                        class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-bold text-sm py-3 rounded-xl justify-center shadow-lg shadow-emerald-500/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 focus:outline-none"
                        :class="{ 'opacity-50 pointer-events-none': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Sending Tautan...</span>
                        <span v-else>Send Password Reset Link</span>
                    </PrimaryButton>
                </div>
            </form>

        </div>
    </div>
</template>