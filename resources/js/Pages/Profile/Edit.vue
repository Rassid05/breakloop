<script setup>
// 1. Ganti AuthenticatedLayout bawaan dengan AppLayout kustom kita
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { User, ShieldAlert, KeyRound } from 'lucide-vue-next';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Account Settings" />

    <AppLayout>
        <div class="text-gray-100 min-h-screen pb-20 antialiased">
            
            <!-- ================= HERO SECTIONS / HEADER PROFIL ================= -->
            <div class="relative rounded-2xl md:rounded-3xl overflow-hidden mb-8 border border-emerald-500/10 shadow-2xl">
                <!-- Lapisan latar belakang gradasi gelap & efek glow neon -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/40 via-[#111317] to-[#0c0e12] z-0"></div>
                <div class="absolute -right-10 -top-10 w-48 h-48 md:w-72 md:h-72 bg-emerald-500/5 rounded-full filter blur-[60px] pointer-events-none"></div>
                
                <div class="relative z-10 p-6 md:p-10 flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-6">
                    <!-- Avatar Dekoratif Besar -->
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl md:rounded-3xl bg-gradient-to-br from-emerald-500/10 to-teal-500/5 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shadow-xl shadow-emerald-500/5 flex-shrink-0">
                        <User :size="32" class="stroke-[1.5]" />
                    </div>
                    
                    <div class="space-y-1">
                        <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase">
                            Account Space
                        </div>
                        <h1 class="text-2xl md:text-3xl font-black tracking-tight text-white">
                            Profile <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Settings</span>
                        </h1>
                        <p class="text-xs text-gray-500 max-w-md">
                            Kelola informasi identitas, perbarui kredensial keamanan, atau sesuaikan akun produser/artist kamu di sini.
                        </p>
                    </div>
                </div>
            </div>

            <!-- ================= FORM GRID SECTIONS ================= -->
            <div class="space-y-6 max-w-5xl">
                
                <!-- 1. Bagian Informasi Profil -->
                <div class="bg-[#111317]/40 border border-gray-900/80 p-5 md:p-8 rounded-2xl md:rounded-3xl backdrop-blur-sm relative group transition-all duration-300 hover:border-gray-800/80">
                    <div class="flex items-center gap-2.5 mb-6 border-b border-gray-900/60 pb-4">
                        <div class="w-7 h-7 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400">
                            <User :size="14" />
                        </div>
                        <div>
                            <h2 class="text-sm md:text-base font-bold text-white">Informasi Profil</h2>
                            <p class="text-[11px] text-gray-500">Perbarui nama pengguna dan alamat email akunmu.</p>
                        </div>
                    </div>
                    <div class="max-w-xl text-gray-300">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                        />
                    </div>
                </div>

                <!-- 2. Bagian Ganti Password -->
                <div class="bg-[#111317]/40 border border-gray-900/80 p-5 md:p-8 rounded-2xl md:rounded-3xl backdrop-blur-sm relative group transition-all duration-300 hover:border-gray-800/80">
                    <div class="flex items-center gap-2.5 mb-6 border-b border-gray-900/60 pb-4">
                        <div class="w-7 h-7 rounded-lg bg-teal-500/10 flex items-center justify-center text-teal-400">
                            <KeyRound :size="14" />
                        </div>
                        <div>
                            <h2 class="text-sm md:text-base font-bold text-white">Keamanan Akun</h2>
                            <p class="text-[11px] text-gray-500">Pastikan akunmu menggunakan password acak yang panjang untuk tetap aman.</p>
                        </div>
                    </div>
                    <div class="max-w-xl text-gray-300">
                        <UpdatePasswordForm />
                    </div>
                </div>

                <!-- 3. Bagian Hapus Akun (Zona Bahaya) -->
                <div class="bg-[#111317]/20 border border-rose-500/10 p-5 md:p-8 rounded-2xl md:rounded-3xl backdrop-blur-sm relative transition-all duration-300 hover:border-rose-500/20">
                    <!-- Pendaran merah tipis untuk menandakan bahaya -->
                    <div class="absolute inset-0 bg-gradient-to-r from-rose-500/[0.01] to-transparent pointer-events-none rounded-2xl md:rounded-3xl"></div>
                    
                    <div class="flex items-center gap-2.5 mb-6 border-b border-rose-950/20 pb-4">
                        <div class="w-7 h-7 rounded-lg bg-rose-500/10 flex items-center justify-center text-rose-400">
                            <ShieldAlert :size="14" />
                        </div>
                        <div>
                            <h2 class="text-sm md:text-base font-bold text-rose-400">Danger Zone</h2>
                            <p class="text-[11px] text-gray-500">Tindakan ini bersifat permanen. Seluruh data sampel dan library-mu akan terhapus.</p>
                        </div>
                    </div>
                    <div class="max-w-xl text-gray-300">
                        <DeleteUserForm />
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Transisi halus global untuk input dan interaksi di dalam halaman profil */
:deep(input[type="text"]),
:deep(input[type="email"]),
:deep(input[type="password"]) {
    background-color: #0b0c0e !important;
    border-color: #1f2937 !important; /* gray-800 */
    color: #f3f4f6 !important; /* text-gray-150 */
    border-radius: 0.75rem !important; /* rounded-xl */
}

:deep(input:focus) {
    border-color: #10b981 !important; /* emerald-500 */
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.15) !important;
}

:deep(button[type="submit"]) {
    background-color: #ffffff !important;
    color: #000000 !important;
    font-weight: 700 !important;
    border-radius: 0.75rem !important;
    transition: all 0.2s ease;
}

:deep(button[type="submit"]:hover) {
    background-color: #34d399 !important; /* emerald-400 */
}
</style>