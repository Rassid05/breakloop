<template>
  <header class="h-16 bg-[#0b0c0e] px-4 md:px-6 flex items-center justify-between border-b border-gray-900 sticky top-0 z-40 select-none">
    <div class="md:hidden text-emerald-500 font-black text-lg tracking-wider flex items-center gap-1">
      <Radio :size="18" /> BreakLoop
    </div>

    <nav class="hidden md:flex items-center gap-4">
      <button 
        @click="deactivateSearch"
        :class="!isSearchActive ? 'text-emerald-400 bg-emerald-950/40 border-emerald-900/30' : 'text-gray-400 hover:text-white bg-[#111317] border-gray-900'"
        class="flex items-center gap-2 text-xs font-bold px-4 py-2 rounded-full border transition"
      >
        <Home :size="14" /> Home
      </button>
      
      <a href="/samples" class="flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-white bg-[#111317] px-4 py-2 rounded-full border border-gray-900 transition">
        <Layers :size="14" /> Samples
      </a>

      <div class="relative flex items-center">
        <input 
          v-model="globalSearchQuery"
          @focus="activateSearch"
          type="text"
          placeholder="Search songs, albums..."
          :class="isSearchActive ? 'w-64 bg-[#181a1f] border-gray-700 pl-9' : 'w-28 bg-[#111317] border-gray-900 pl-9 cursor-pointer'"
          class="text-xs font-bold text-gray-300 pr-7 py-2 rounded-full border focus:outline-none transition-all duration-300 ease-in-out"
        />
        <Search :size="14" class="absolute left-3.5 text-gray-400 pointer-events-none" />
        <button v-if="isSearchActive" @click="deactivateSearch" class="absolute right-3 text-gray-400 hover:text-white text-[10px]">✕</button>
      </div>

      <a href="#" class="flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-white bg-[#111317] px-4 py-2 rounded-full border border-gray-900 transition">
        <UserCheck :size="14" /> Become an Artist
      </a>
    </nav>

<!-- User Section Rights -->
<!-- User Section Rights (Khusus User Terautentikasi) -->
    <div class="flex items-center gap-2 md:gap-4 relative">
      <!-- Notification Dropdown Slot -->
      <slot name="notification" />

      <!-- User Profile Dropdown Container -->
      <div class="relative">
        <div 
          @click="isProfileOpen = !isProfileOpen"
          :class="isProfileOpen ? 'border-gray-700 bg-gray-800' : 'border-gray-900 bg-[#111317]'"
          class="flex items-center gap-2 md:gap-3 p-1 md:py-1.5 md:pl-2 md:pr-4 rounded-full cursor-pointer border hover:bg-gray-800 transition"
        >
          <!-- Mengambil foto profile user atau fallback ke picsum jika kosong -->
          <img :src="$page.props.auth?.user?.profile_photo_url || 'https://picsum.photos/40/40'" class="w-7 h-7 rounded-full object-cover shadow" />
          <div class="text-left hidden md:block">
            <p class="text-xs font-bold text-white leading-tight flex items-center gap-1">
              Hi, {{ $page.props.auth?.user?.name ? $page.props.auth.user.name.split(' ')[0] : 'User' }}
              <ChevronDown :size="12" :class="isProfileOpen ? 'rotate-180 text-white' : 'text-gray-400'" class="transition-transform duration-200" />
            </p>
            <p class="text-[9px] text-gray-500 font-medium leading-none">Listener</p>
          </div>
        </div>

        <!-- Menu Dropdown Profil -->
        <div 
          v-if="isProfileOpen" 
          class="absolute right-0 top-12 w-48 bg-[#111317] border border-gray-800 rounded-2xl p-2 shadow-xl shadow-black/80 z-50 animate-in fade-in slide-in-from-top-3 duration-200"
        >
          <Link 
              href="/profile" 
              class="w-full text-left flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-300 hover:text-white hover:bg-[#181a1f] rounded-xl transition focus:outline-none"
          >
              <User :size="14" /> 
              <span>My Profile</span>
          </Link>
          <button class="w-full text-left flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-gray-300 hover:text-white hover:bg-[#181a1f] rounded-xl transition">
            <Settings :size="14" /> Settings
          </button>
          <hr class="border-gray-800 my-1">
          <Link 
            href="/logout" 
            method="post" 
            as="button" 
            class="w-full text-left flex items-center gap-2.5 px-3 py-2 text-xs font-semibold text-red-400 hover:text-red-300 hover:bg-red-950/20 rounded-xl transition focus:outline-none"
          >
            <LogOut :size="14" /> Log Out
          </Link>
        </div>

        <!-- Overlay transparan untuk menutup dropdown profil -->
        <div v-if="isProfileOpen" @click="isProfileOpen = false" class="fixed inset-0 z-40 bg-transparent"></div>
      </div>

      <!-- Token Badge -->
      <div class="bg-gradient-to-r from-amber-600 to-yellow-500 text-white px-2.5 py-1 md:px-3 md:py-1.5 rounded-full flex items-center gap-1.5 shadow-md">
        <Coins :size="14" class="text-yellow-200" />
        <div class="text-right">
          <p class="text-xs font-black leading-none">120</p>
          <p class="text-[8px] text-yellow-100 uppercase font-bold hidden sm:block">Tokens</p>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Home, Layers, Search, UserCheck, ChevronDown, Radio, Coins, User, Settings, LogOut } from 'lucide-vue-next';
import { isSearchActive, globalSearchQuery } from '../searchState';

const isProfileOpen = ref(false);

const activateSearch = () => {
  isSearchActive.value = true;
};

const deactivateSearch = () => {
  isSearchActive.value = false;
  globalSearchQuery.value = '';
};
</script>