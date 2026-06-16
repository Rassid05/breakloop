<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import { AlertTriangle, Trash2 } from 'lucide-vue-next'; // Menggunakan ikon bahaya siber

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header class="space-y-1">
            <h2 class="text-base font-bold text-rose-400 flex items-center gap-2">
                <Trash2 :size="16" /> Delete Account
            </h2>

            <p class="text-xs text-gray-400 leading-relaxed max-w-2xl">
                Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan.
            </p>
        </header>

        <button 
            @click="confirmUserDeletion"
            class="inline-flex items-center gap-2 bg-rose-500 hover:bg-rose-600 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-lg shadow-rose-500/10 focus:outline-none"
        >
            <Trash2 :size="14" />
            <span>Hapus Akun Permanen</span>
        </button>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6 md:p-8 bg-[#0b0c0e] border border-gray-900 rounded-2xl md:rounded-3xl relative overflow-hidden text-gray-200">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-rose-500/[0.03] rounded-full filter blur-[40px] pointer-events-none"></div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center flex-shrink-0">
                        <AlertTriangle :size="20" class="stroke-[2]" />
                    </div>
                    <div>
                        <h2 class="text-base md:text-lg font-black text-white tracking-tight">
                            Apakah Anda yakin ingin menghapus akun?
                        </h2>
                        <p class="mt-2 text-xs text-gray-400 leading-relaxed">
                            Tindakan ini tidak dapat dibatalkan. Silakan masukkan password akun BreakLoop Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus identitas akun ini secara permanen.
                        </p>
                    </div>
                </div>

                <div class="mt-6 pl-0 md:pl-14">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <div class="relative max-w-md">
                        <input
                            id="password"
                            ref="passwordInput"
                            v-model="form.password"
                            type="password"
                            placeholder="Konfirmasi Password Anda"
                            class="w-full bg-[#111317] border border-gray-800 rounded-xl px-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-rose-500/50 focus:ring-1 focus:ring-rose-500/30 transition-all"
                            @keyup.enter="deleteUser"
                        />
                    </div>

                    <InputError :message="form.errors.password" class="mt-2 text-rose-400 text-xs" />
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-900/60 pt-4">
                    <button 
                        @click="closeModal"
                        class="px-4 py-2.5 rounded-xl text-xs font-bold bg-transparent text-gray-400 hover:text-white border border-gray-800 hover:bg-[#111317] transition-all focus:outline-none"
                    >
                        Batal
                    </button>

                    <button
                        class="px-4 py-2.5 rounded-xl text-xs font-bold bg-rose-500 hover:bg-rose-600 text-white disabled:opacity-40 transition-all focus:outline-none shadow-md shadow-rose-500/10 flex items-center gap-1.5"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        <span>Hapus Sekarang</span>
                    </button>
                </div>
            </div>
        </Modal>
    </section>
</template>