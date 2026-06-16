<template>
  <MusicLayout>
    <template #sidebar>
      <Sidebar />
    </template>

    <template #topbar>
      <Topbar>
        <template #notification>
          <NotificationDropdown />
        </template>
      </Topbar>
    </template>

    <template #content>
        <div class="h-full overflow-y-auto pr-1 custom-scrollbar">

            <div v-if="isSearchActive">
            <div class="mb-6">
                <h2 class="text-lg font-black text-white mb-1">Search Results</h2>
                <p class="text-xs text-gray-400">Showing results for <span class="text-emerald-400">"{{ globalSearchQuery || '...' }}"</span></p>
            </div>

            <div v-if="searchedSongs.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                <SongCard 
                v-for="(song, i) in searchedSongs" :key="i"
                :title="song.title" 
                :artist="song.artist" 
                :image="song.image" 
                />
            </div>

            <div v-else class="text-center py-12 bg-[#111317] rounded-2xl border border-gray-900">
                <p class="text-sm text-gray-400">No songs or albums found.</p>
            </div>
            </div>

            <div v-else>
            <div class="bg-gradient-to-r from-emerald-950 via-[#18103c] to-[#251545] rounded-2xl md:rounded-3xl p-5 md:p-8 relative overflow-hidden flex items-center justify-between mb-6 md:mb-8 border border-purple-900/30">
                <div class="z-10 max-w-sm md:max-w-md">
                <span class="text-[10px] md:text-xs font-bold text-emerald-400 tracking-wider uppercase mb-1 md:mb-2 block">BreakLoop Premium</span>
                <h1 class="text-xl md:text-3xl font-black text-white mb-1 md:mb-2 tracking-tight">Unlock all music.<br>No limits.</h1>
                <p class="text-[11px] md:text-xs text-gray-300 mb-4">Dengarkan jutaan remix & breakbeat tanpa batas dengan Premium.</p>
                <button class="bg-emerald-500 hover:bg-emerald-400 text-black text-[11px] md:text-xs font-bold px-4 py-2 md:px-5 md:py-2.5 rounded-xl transition">
                    Explore Premium
                </button>
                </div>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 w-32 h-32 md:w-48 md:h-48 opacity-40 md:opacity-80 pointer-events-none hidden sm:block">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=300" class="w-full h-full object-cover rounded-full mix-blend-screen" />
                </div>
            </div>

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold text-white tracking-wide">Top Picks For You</h2>
                <a href="#" class="text-xs font-medium text-gray-500 hover:text-emerald-500 transition">Show all</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4 mb-8">
                <SongCard 
                v-for="(song, i) in topPicks" :key="i"
                :title="song.title" 
                :artist="song.artist" 
                :image="song.image" 
                />
            </div>

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold text-white tracking-wide">Trending Now</h2>
                <a href="#" class="text-xs font-medium text-gray-500 hover:text-emerald-500 transition">Show all</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                <TrendingCard 
                v-for="(trend, i) in trending" :key="i"
                :title="trend.title" 
                :count="trend.count" 
                :image="trend.image" 
                />
            </div>
            </div>

        </div>
        </template>

<!-- Template Right Sidebar (Featured Album & Popular Artist) -->
    <template #right-sidebar>
      <!-- Gunakan flex-col h-full agar membagi sisa ruang tinggi vertikal layar secara sempurna -->
      <div class="flex flex-col h-full gap-6 overflow-hidden">
        
        <!-- Featured Album Block (Tetap Mengunci / Tidak Ikut Di-scroll) -->
        <div class="flex-shrink-0">
          <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Featured Album</h3>
          <div class="bg-[#111317] rounded-2xl p-4 border border-gray-900 group">
            <div class="relative overflow-hidden rounded-xl aspect-square mb-3">
              <img src="https://picsum.photos/300/300?random=11" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
              <button class="absolute bottom-3 right-3 w-10 h-10 bg-white text-black font-bold rounded-full flex items-center justify-center shadow-lg transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300 pl-0.5">▶</button>
            </div>
            <h4 class="text-xs font-bold text-white mb-0.5">Disko Tanah</h4>
            <p class="text-[11px] text-gray-500">Bassgilano</p>
          </div>
        </div>

        <!-- Popular Artists Block (Bisa Di-scroll Secara Mandiri) -->
        <!-- flex-1 mengambil sisa ruang bawah, overflow-y-auto mengaktifkan scroll di area ini saja -->
        <div class="flex flex-1 flex-col overflow-hidden">
          <div class="flex items-center justify-between mb-3 flex-shrink-0">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Popular Artists</h3>
            <a href="#" class="text-[11px] text-emerald-500 hover:underline">View all</a>
          </div>
          
          <!-- Bagian List Artis yang diberikan Scroll Mandiri -->
          <div class="flex-1 overflow-y-auto pr-1 space-y-3 bg-[#111317] p-4 rounded-2xl border border-gray-900 custom-scrollbar">
            <!-- Menambah jumlah data tiruan agar daftarnya panjang dan bisa di-scroll -->
            <ArtistList 
              v-for="(artist, i) in [...popularArtists, ...popularArtists]" :key="i"
              :name="artist.name"
              :followers="artist.followers"
              :image="artist.image"
            />
          </div>
        </div>

      </div>
    </template>

    <template #player>
      <PlayerBar />
    </template>
  </MusicLayout>
</template>

<script setup>
import MusicLayout from '../../Layouts/MusicLayout.vue';
import Sidebar from '../../ComponentsDiscover/Sidebar.vue';
import Topbar from '../../ComponentsDiscover/Topbar.vue';
import NotificationDropdown from '../../ComponentsDiscover/NotificationDropdown.vue';
import SongCard from '../../ComponentsDiscover/SongCard.vue';
import TrendingCard from '../../ComponentsDiscover/TrendingCard.vue';
import ArtistList from '../../ComponentsDiscover/ArtistList.vue';
import PlayerBar from '../../ComponentsDiscover/PlayerBar.vue';

// Mock Data Dummy sesuai dengan gambar
const topPicks = [
  { title: 'Disko Tanah', artist: 'Bassgilano', image: 'https://picsum.photos/150/150?random=1' },
  { title: 'Terpukau', artist: 'Astrid', image: 'https://picsum.photos/150/150?random=2' },
  { title: 'Recycle +', artist: 'Dewi - Dewi', image: 'https://picsum.photos/150/150?random=3' },
  { title: 'Live In Living Room', artist: 'tipe-X', image: 'https://picsum.photos/150/150?random=4' },
  { title: 'Mestakung', artist: 'Souljah', image: 'https://picsum.photos/150/150?random=5' },
  { title: 'Fade2Black', artist: 'Fade2Black', image: 'https://picsum.photos/150/150?random=6' }
];

const trending = [
  { title: 'Remix Hits', count: '50', image: 'https://picsum.photos/150/200?random=7' },
  { title: 'Breakbeat Party', count: '40', image: 'https://picsum.photos/150/200?random=8' },
  { title: 'Old School Hits', count: '45', image: 'https://picsum.photos/150/200?random=9' },
  { title: 'DJ Essentials', count: '60', image: 'https://picsum.photos/150/200?random=10' },
  { title: 'Lokal Pride', count: '55', image: 'https://picsum.photos/150/200?random=11' },
  { title: 'Festival Vibes', count: '50', image: 'https://picsum.photos/150/200?random=12' }
];

const popularArtists = [
  { name: 'Bassgilano', followers: '120K', image: 'https://picsum.photos/50/50?random=13' },
  { name: 'DJ BreakLoop', followers: '98K', image: 'https://picsum.photos/50/50?random=14' },
  { name: 'tipe-X', followers: '80K', image: 'https://picsum.photos/50/50?random=15' },
  { name: 'Dewa 19', followers: '75K', image: 'https://picsum.photos/50/50?random=16' },
  { name: 'Astrid', followers: '65K', image: 'https://picsum.photos/50/50?random=17' }
];

import { computed } from 'vue';
    import { isSearchActive, globalSearchQuery } from '../../searchState';

    // Gabungkan data untuk basis pencarian lagu
    const allSongs = computed(() => {
    return [...topPicks]; // Anda bisa menambahkan array lagu lain di sini
    });

    // Fungsi menyaring lagu di tampilan tengah secara real-time
    const searchedSongs = computed(() => {
    if (!globalSearchQuery.value) return allSongs.value;
    return allSongs.value.filter(song => 
        song.title.toLowerCase().includes(globalSearchQuery.value.toLowerCase()) ||
        song.artist.toLowerCase().includes(globalSearchQuery.value.toLowerCase())
    );
    });
</script>