<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Radio, Mail, Lock } from 'lucide-vue-next';

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
    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col items-center justify-center p-4 relative selection:bg-emerald-500 selection:text-black">
        
        <div class="absolute w-80 h-80 bg-emerald-500/5 rounded-full filter blur-[120px] top-1/4 left-1/4 pointer-events-none"></div>
        <div class="absolute w-80 h-80 bg-purple-500/5 rounded-full filter blur-[120px] bottom-1/4 right-1/4 pointer-events-none"></div>

        <div class="w-full max-w-md bg-[#111317]/80 backdrop-blur-xl border border-gray-800/80 p-8 rounded-3xl shadow-2xl shadow-black/50 z-10">
            
            <Head title="Reset Password" />

            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-2 text-emerald-500 font-black text-2xl tracking-wider justify-center mb-2">
                    <Radio :size="26" class="text-emerald-500 animate-pulse" />
                    BreakLoop
                </div>
                <h2 class="text-lg font-bold text-gray-200">Reset Password</h2>
                <p class="text-xs text-gray-500 mt-1">Please enter your new security credentials</p>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <InputLabel for="email" value="Email Address" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="email"
                            type="email"
                            class="block w-full bg-[#16171b] border-gray-800/60 text-gray-500 text-sm pl-10 pr-4 py-2.5 rounded-xl cursor-not-allowed select-none focus:ring-0 focus:border-gray-800/60"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            disabled
                        />
                        <Mail :size="16" class="absolute left-3.5 text-gray-600" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="New Password" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

                    <div class="relative flex items-center">
                        <TextInput
                            id="password"
                            type="password"
                            class="block w-full bg-[#181a1f] border-gray-800/80 focus:border-emerald-500/50 text-gray-200 text-sm pl-10 pr-4 py-2.5 rounded-xl transition focus:outline-none focus:ring-0"
                            v-model="form.password"
                            required
                            autofocus
                            autocomplete="new-password"
                            placeholder="••••••••"
                        />
                        <Lock :size="16" class="absolute left-3.5 text-gray-500" />
                    </div>

                    <InputError class="mt-1.5 text-xs text-red-400" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="password_confirmation" value="Confirm New Password" class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1.5 block" />

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

                <div class="pt-2">
                    <PrimaryButton
                        class="w-full bg-emerald-500 hover:bg-emerald-400 text-black font-bold text-sm py-3 rounded-xl justify-center shadow-lg shadow-emerald-500/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 focus:outline-none"
                        :class="{ 'opacity-50 pointer-events-none': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Updating password...</span>
                        <span v-else>Update Password</span>
                    </PrimaryButton>
                </div>
            </form>

        </div>
    </div>
</template>