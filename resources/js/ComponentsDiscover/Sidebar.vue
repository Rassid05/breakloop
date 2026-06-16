<template>
  <aside class="w-64 bg-[#111317] border-r border-gray-900 flex flex-col p-4 justify-between h-full select-none">
    <div>
      <div class="flex items-center gap-2.5 px-2 py-3 mb-6">
        <Link :href="route().has('dashboard') ? route('dashboard') : '#'" class="text-emerald-500 font-black text-xl tracking-wider flex items-center gap-1.5 focus:outline-none">
          <Radio :size="22" class="text-emerald-500 animate-pulse" />
          BreakLoop
        </Link>
      </div>

      <div class="mb-6">
        <div class="flex items-center justify-between text-gray-500 text-[10px] font-bold px-2 mb-3 tracking-widest uppercase">
          <span>Your Library</span>
          <Link 
            :href="route().has('playlist.create') ? route('playlist.create') : '#'" 
            class="hover:text-white transition focus:outline-none"
          >
            <Plus :size="14" />
          </Link>
        </div>
        <ul class="space-y-1">
          <li>
            <Link 
              :href="route().has('liked-songs') ? route('liked-songs') : '#'" 
              class="flex items-center gap-3 px-3 py-2 rounded-xl transition text-xs font-semibold focus:outline-none"
              :class="route().current('liked-songs') ? 'bg-emerald-500 text-black font-bold' : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
            >
              <Heart :size="16" :class="route().current('liked-songs') ? 'text-black fill-black' : 'text-purple-500 fill-purple-500'" /> 
              Liked Songs
            </Link>
          </li>
          <li>
            <Link 
              :href="route().has('recently-played') ? route('recently-played') : '#'" 
              class="flex items-center gap-3 px-3 py-2 rounded-xl transition text-xs font-semibold focus:outline-none"
              :class="route().current('recently-played') ? 'bg-emerald-500 text-black font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
            >
              <History :size="16" /> 
              Recently Played
            </Link>
          </li>
          <li>
            <Link 
              :href="route().has('playlists.index') ? route('playlists.index') : '#'" 
              class="flex items-center gap-3 px-3 py-2 rounded-xl transition text-xs font-semibold focus:outline-none"
              :class="route().current('playlists.index') ? 'bg-emerald-500 text-black font-bold' : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
            >
              <FolderHeart :size="16" /> 
              My Playlists
            </Link>
          </li>
        </ul>
      </div>

      <div>
        <div class="flex items-center justify-between text-gray-500 text-[10px] font-bold px-2 mb-3 tracking-widest uppercase">
          <span>Artists</span>
          <Link :href="route().has('artists.index') ? route('artists.index') : '#'" class="text-emerald-500 text-[11px] font-semibold hover:underline focus:outline-none">
            View all
          </Link>
        </div>
        
        <div class="relative mb-4 px-2">
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Search artist..." 
            class="w-full bg-[#181a1f] text-xs text-gray-300 pl-8 pr-7 py-2 rounded-xl focus:outline-none border border-transparent focus:border-gray-800 transition" 
          />
          <Search :size="14" class="absolute left-4 top-2.5 text-gray-500" />
          
          <button 
            v-if="searchQuery" 
            @click="searchQuery = ''" 
            class="absolute right-4 top-2.5 text-gray-500 hover:text-white transition text-xs"
          >
            ✕
          </button>
        </div>
        
        <div class="space-y-3 max-h-[220px] overflow-y-auto px-2 custom-scrollbar">
          <div 
            v-for="(artist, index) in filteredArtists" 
            :key="index" 
            class="group cursor-pointer"
          >
            <Link :href="route().has('artists.show') ? route('artists.show', index) : '#'" class="flex items-center gap-3 focus:outline-none">
              <img :src="artist.image" class="w-8 h-8 rounded-full object-cover group-hover:opacity-80 transition" />
              <div class="min-w-0">
                <p class="text-xs font-semibold truncate text-gray-300 group-hover:text-white transition">{{ artist.name }}</p>
                <p class="text-[10px] text-gray-500">{{ artist.role }}</p>
              </div>
            </Link>
          </div>

          <div v-if="filteredArtists.length === 0" class="text-center py-4 text-xs text-gray-500">
            Artist tidak ditemukan
          </div>
        </div>
      </div>
    </div>

    <div class="bg-[#181a1f] p-3 rounded-2xl flex items-center justify-between border border-gray-900 shadow-sm">
      <div class="flex items-center gap-3 min-w-0">
        <img src="https://picsum.photos/50/50" class="w-9 h-9 rounded-xl object-cover flex-shrink-0" />
        <div class="min-w-0">
          <h4 class="text-xs font-bold text-white truncate">Anjing Kacili</h4>
          <p class="text-[10px] text-gray-400 truncate">Bassgilano</p>
        </div>
      </div>
      <button class="text-gray-500 hover:text-red-500 transition flex-shrink-0">
        <Heart :size="14" />
      </button>
    </div>
  </aside>
</template>

<script setup>
import { ref, computed } from 'vue';
// IMPORT LINK DARI INERTIA DI SINI
import { Link } from '@inertiajs/vue3';
import { Radio, Plus, Heart, History, FolderHeart, Search } from 'lucide-vue-next';

const searchQuery = ref('');

const artists = ref([
  { name: 'DJ BreakLoop', role: 'Artist', image: 'https://picsum.photos/40/40?random=1' },
  { name: 'Disko Tanah', role: 'Artist', image: 'https://picsum.photos/40/40?random=2' },
  { name: 'Bassgilano', role: 'Artist', image: 'https://picsum.photos/40/40?random=3' },
  { name: 'tipe-X', role: 'Artist', image: 'https://picsum.photos/40/40?random=4' },
  { name: 'Dewa 19', role: 'Artist', image: 'https://picsum.photos/40/40?random=5' },
  { name: 'Astrid', role: 'Artist', image: 'https://picsum.photos/40/40?random=6' },
  { name: 'Shaggydog', role: 'Artist', image: 'https://picsum.photos/40/40?random=7' },
  { name: 'Fade2Black', role: 'Artist', image: 'https://picsum.photos/40/40?random=8' }
]);

const filteredArtists = computed(() => {
  return artists.value.filter(artist => 
    artist.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
</script>