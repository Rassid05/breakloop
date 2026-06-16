<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Radio, MailOpen, LogOut } from 'lucide-vue-next';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>
    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col items-center justify-center p-4 relative selection:bg-emerald-500 selection:text-black">
        
        <div class="absolute w-80 h-80 bg-emerald-500/5 rounded-full filter blur-[120px] top-1/4 left-1/4 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-purple-500/5 rounded-full filter blur-[120px] bottom-1/4 right-1/4 pointer-events-none"></div>

        <div class="w-full max-w-md bg-[#111317]/80 backdrop-blur-xl border border-gray-800/80 p-8 rounded-3xl shadow-2xl shadow-black/50 z-10">
            
            <Head title="Email Verification" />

            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 text-emerald-500 font-black text-2xl tracking-wider justify-center mb-6">
                    <Radio :size="26" class="text-emerald-500 animate-pulse" />
                    BreakLoop
                </div>
                
                <div class="w-16 h-16 bg-emerald-950/50 border border-emerald-900/40 rounded-2xl flex items-center justify-center mx-auto mb-4 text-emerald-400">
                    <MailOpen :size="32" class="animate-bounce duration-1000" style="animation-duration: 3s" />
                </div>
                
                <h2 class="text-lg font-bold text-gray-200">Verify Your Email</h2>
            </div>

            <div class="mb-5 text-xs text-gray-400 text-center leading-relaxed">
                Thanks for signing up! Before getting started, could you verify your
                email address by clicking on the link we just emailed to you? If you
                didn't receive the email, we will gladly send you another.
            </div>

            <div
                class="mb-5 text-xs font-medium text-emerald-400 bg-emerald-950/30 border border-emerald-900/50 p-3 rounded-xl text-center"
                v-if="verificationLinkSent"
            >
                A new verification link has been sent to the email address you
                provided during registration.
            </div>

            <form @submit.prevent="submit">
                <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <PrimaryButton
                        class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-400 text-black font-bold text-xs py-3 px-5 rounded-xl justify-center shadow-lg shadow-emerald-500/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 focus:outline-none"
                        :class="{ 'opacity-50 pointer-events-none': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Sending Link...</span>
                        <span v-else>Resend Verification Email</span>
                    </PrimaryButton>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full sm:w-auto text-center flex items-center justify-center gap-2 text-xs font-semibold text-gray-500 hover:text-red-400 py-3 px-4 rounded-xl hover:bg-red-950/10 transition focus:outline-none"
                    >
                        <LogOut :size="14" />
                        Log Out
                    </Link>
                </div>
            </form>

        </div>
    </div>
</template>