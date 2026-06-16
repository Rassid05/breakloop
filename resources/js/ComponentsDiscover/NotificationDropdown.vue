<template>
  <div class="relative flex items-center">
    <button 
      @click="isOpen = !isOpen"
      :class="isOpen ? 'text-white border-gray-700 bg-gray-800' : 'text-gray-400 hover:text-white bg-[#111317] border-gray-900'"
      class="p-2.5 rounded-full relative border transition focus:outline-none"
    >
      <Bell :size="16" />
      <span v-if="notifications.length > 0" class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white font-black text-[9px] flex items-center justify-center rounded-full border border-[#0b0c0e]">
        {{ notifications.length }}
      </span>
    </button>

    <div 
      v-if="isOpen" 
      class="absolute right-0 top-12 w-72 bg-[#111317] border border-gray-800 rounded-2xl p-4 shadow-xl shadow-black/80 z-50 animate-in fade-in slide-in-from-top-3 duration-200"
    >
      <div class="flex items-center justify-between border-b border-gray-800 pb-2 mb-3">
        <h3 class="text-xs font-bold text-white uppercase tracking-wider">Notifications</h3>
        <button @click="clearAll" class="text-[10px] text-gray-500 hover:text-emerald-400 transition">Clear all</button>
      </div>

      <div class="space-y-2.5 max-h-60 overflow-y-auto custom-scrollbar">
        <div 
          v-for="item in notifications" 
          :key="item.id" 
          class="flex gap-3 p-2 rounded-xl hover:bg-[#181a1f] transition cursor-pointer"
        >
          <div class="w-2 h-2 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></div>
          <div class="min-w-0">
            <p class="text-xs text-gray-200 font-medium leading-tight">{{ item.text }}</p>
            <p class="text-[9px] text-gray-500 mt-0.5">{{ item.time }}</p>
          </div>
        </div>

        <div v-if="notifications.length === 0" class="text-center py-6 text-xs text-gray-500">
          No new notifications
        </div>
      </div>
    </div>

    <div v-if="isOpen" @click="isOpen = false" class="fixed inset-0 z-40 bg-transparent"></div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Bell } from 'lucide-vue-next';

const isOpen = ref(false);

// Data dummy notifikasi
const notifications = ref([
  { id: 1, text: 'Bassgilano just uploaded a new track "Disko Tanah Remix"', time: '2 mins ago' },
  { id: 2, text: 'Successfully purchased 50 Tokens via Laragon Wallet', time: '1 hour ago' },
  { id: 3, text: 'Your followed artist DJ BreakLoop is now live!', time: 'Yesterday' }
]);

const clearAll = () => {
  notifications.value = [];
};
</script>