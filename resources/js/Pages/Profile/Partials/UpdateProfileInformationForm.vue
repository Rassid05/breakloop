<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { User, CheckCircle2, AlertCircle } from 'lucide-vue-next'; // Import ikon pendukung

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section class="space-y-6">
        <header class="space-y-1">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <User :size="16" class="text-emerald-400" /> Informasi Akun
            </h2>

            <p class="text-xs text-gray-400 leading-relaxed max-w-xl">
                Perbarui nama profil publik dan alamat email korespondensi akun utama Anda.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-5 max-w-xl"
        >
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-bold text-gray-400 tracking-wide">
                    Nama Lengkap
                </label>
                <input
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama profil Anda"
                    class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                />
                <InputError class="mt-1 text-xs text-rose-400" :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <label for="email" class="text-xs font-bold text-gray-400 tracking-wide">
                    Alamat Email
                </label>
                <input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="nama@email.com"
                    class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                />
                <InputError class="mt-1 text-xs text-rose-400" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null" class="bg-amber-500/5 border border-amber-500/10 p-4 rounded-xl space-y-2">
                <div class="flex items-start gap-2.5">
                    <AlertCircle :size="16" class="text-amber-500 mt-0.5 flex-shrink-0" />
                    <div>
                        <p class="text-xs font-semibold text-amber-400">
                            Alamat email Anda belum terverifikasi.
                        </p>
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="text-[11px] text-gray-400 underline hover:text-white transition-colors focus:outline-none mt-1"
                        >
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </Link>
                    </div>
                </div>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="text-[11px] font-medium text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-2 rounded-lg flex items-center gap-1.5 mt-2"
                >
                    <CheckCircle2 :size="12" /> Link verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button 
                    type="submit"
                    :disabled="form.processing"
                    class="bg-white hover:bg-emerald-400 text-black font-bold text-xs px-5 py-2.5 rounded-xl transition-all duration-300 disabled:opacity-40 shadow-lg shadow-white/5 focus:outline-none"
                >
                    Simpan Perubahan
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
                        <span>Perubahan disimpan.</span>
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>