<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { KeyRound, CheckCircle2 } from 'lucide-vue-next'; // Import ikon modern

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="space-y-6">
        <header class="space-y-1">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <KeyRound :size="16" class="text-emerald-400" /> Update Password
            </h2>

            <p class="text-xs text-gray-400 leading-relaxed max-w-xl">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan data produksi Anda tetap optimal.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-5 max-w-xl">
            
            <div class="space-y-1.5">
                <label for="current_password" class="text-xs font-bold text-gray-400 tracking-wide">
                    Password Saat Ini
                </label>
                <input
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="Masukkan password lama"
                    class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                />
                <InputError :message="form.errors.current_password" class="mt-1 text-xs text-rose-400" />
            </div>

            <div class="space-y-1.5">
                <label for="password" class="text-xs font-bold text-gray-400 tracking-wide">
                    Password Baru
                </label>
                <input
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Buat password baru"
                    class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                />
                <InputError :message="form.errors.password" class="mt-1 text-xs text-rose-400" />
            </div>

            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-xs font-bold text-gray-400 tracking-wide">
                    Konfirmasi Password Baru
                </label>
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Ulangi password baru"
                    class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                />
                <InputError :message="form.errors.password_confirmation" class="mt-1 text-xs text-rose-400" />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button 
                    type="submit"
                    :disabled="form.processing"
                    class="bg-white hover:bg-emerald-400 text-black font-bold text-xs px-5 py-2.5 rounded-xl transition-all duration-300 disabled:opacity-40 shadow-lg shadow-white/5 focus:outline-none"
                >
                    Update Password
                </button>

                <Transition
                    enter-active-class="transition duration-300 ease-out"
                    enter-from-class="opacity-0 translate-x-2"
                    leave-active-class="transition duration-200 ease-in"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-xs font-semibold text-emerald-400 flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 rounded-xl"
                    >
                        <CheckCircle2 :size="13" />
                        <span>Berhasil diperbarui.</span>
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>