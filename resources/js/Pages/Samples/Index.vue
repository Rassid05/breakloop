<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref, computed } from 'vue'
import { 
    Play, 
    Pause, 
    Search, 
    Coins, 
    ShoppingBag, 
    Music, 
    Disc, 
    Volume2,
    SlidersHorizontal
} from 'lucide-vue-next'

const currentPlayingId = ref(null)
const isPlaying = ref(false)
const activeSample = ref(null)
const searchQuery = ref('')
const selectedCategory = ref('All')

const categories = ['All', 'Vocal', 'Drum', 'FX', 'Breakbeat']

const samples = [
    {
        id: 1,
        title: 'Breakbeat Vocal Pack',
        category: 'Vocal',
        token: 1,
        creator: 'DJ BreakLoop',
        image: 'https://picsum.photos/400/400?random=1',
        audioUrl: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3'
    },
    {
        id: 2,
        title: 'DJ Intro Pack',
        category: 'FX',
        token: 2,
        creator: 'Bassgilano',
        image: 'https://picsum.photos/400/400?random=2',
        audioUrl: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3'
    },
    {
        id: 3,
        title: 'Kick & Bass Pack',
        category: 'Drum',
        token: 3,
        creator: 'Disko Tanah',
        image: 'https://picsum.photos/400/400?random=3',
        audioUrl: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3'
    },
    {
        id: 4,
        title: 'Remix Starter Kit',
        category: 'Breakbeat',
        token: 5,
        creator: 'DJ BreakLoop',
        image: 'https://picsum.photos/400/400?random=4',
        audioUrl: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3'
    }
]

const filteredSamples = computed(() => {
    return samples.filter(sample => {
        const matchesSearch = sample.title.toLowerCase().includes(searchQuery.value.toLowerCase())
        const matchesCategory = selectedCategory.value === 'All' || sample.category === selectedCategory.value
        return matchesSearch && matchesCategory
    })
})

const togglePreview = (sample) => {
    if (currentPlayingId.value === sample.id) {
        isPlaying.value = !isPlaying.value
    } else {
        currentPlayingId.value = sample.id
        activeSample.value = sample
        isPlaying.value = true
    }
}

// Directive Pendukung Audio Player
const vAudioControl = {
    updated: (el, binding) => {
        if (binding.value) { el.play().catch(() => {}); } else { el.pause(); }
    }
}
</script>

<template>
    <AppLayout>
        <div class="text-gray-100 min-h-screen pb-36 antialiased">
            
            <!-- ================= HERO SECTION ================= -->
            <div class="relative rounded-2xl md:rounded-3xl overflow-hidden mb-6 md:mb-10 border border-emerald-500/10 shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/80 via-[#111317] to-[#0c0e12] z-0"></div>
                <div class="absolute -right-10 -top-10 w-48 h-48 md:w-72 md:h-72 bg-emerald-500/10 rounded-full filter blur-[60px] pointer-events-none"></div>
                
                <div class="relative z-10 p-6 md:p-12 max-w-2xl space-y-3 md:space-y-4">
                    <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-[10px] md:text-[11px] font-bold tracking-wider uppercase">
                        <Disc :size="12" class="animate-spin" style="animation-duration: 4s" /> Audio Marketplace
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black tracking-tight text-white leading-none">
                        Sample <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Marketplace</span>
                    </h1>
                    <p class="text-xs md:text-sm text-gray-400 leading-relaxed max-w-md">
                        Tingkatkan kualitas produksi aransemen musikmu dengan sample kit eksklusif berlisensi komersial penuh.
                    </p>
                </div>
            </div>

            <!-- ================= UTILITIES: SEARCH & FILTER KATEGORI ================= -->
            <div class="space-y-4 md:space-y-6 bg-[#111317]/40 border border-gray-900/60 p-4 md:p-6 rounded-2xl backdrop-blur-sm mb-6 md:mb-10">
                <div class="flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between">
                    <!-- Kolom Pencarian -->
                    <div class="relative w-full md:max-w-md group">
                        <Search class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors" :size="16" />
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari judul audio sample pack..."
                            class="w-full bg-[#0b0c0e] border border-gray-800/80 rounded-xl md:rounded-2xl pl-11 pr-4 py-3 text-xs md:text-sm text-white placeholder-gray-600 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/30 transition-all"
                        >
                    </div>

                    <!-- Indikator Jumlah -->
                    <div class="flex items-center gap-2 text-[11px] md:text-xs text-gray-500 font-medium md:self-center">
                        <SlidersHorizontal :size="12" />
                        <span>Menampilkan {{ filteredSamples.length }} Audio Kit</span>
                    </div>
                </div>

                <!-- Pilihan Kategori (Responsive Scrollable Horizontal di HP) -->
                <div class="flex items-center overflow-x-auto no-scrollbar gap-2 border-t border-gray-900/40 pt-4 -mx-4 px-4 md:mx-0 md:px-0">
                    <button
                        v-for="category in categories"
                        :key="category"
                        @click="selectedCategory = category"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-all flex-shrink-0 focus:outline-none"
                        :class="selectedCategory === category 
                            ? 'bg-emerald-500 text-black shadow-md shadow-emerald-500/20' 
                            : 'bg-[#0b0c0e] text-gray-400 border border-gray-800/60 hover:border-gray-700'"
                    >
                        {{ category }}
                    </button>
                </div>
            </div>

            <!-- ================= GRID SAMPLES RESPONSIVE ================= -->
            <div v-if="filteredSamples.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                <div
                    v-for="sample in filteredSamples"
                    :key="sample.id"
                    class="bg-[#111317]/50 border border-gray-900/80 rounded-2xl md:rounded-3xl overflow-hidden hover:border-gray-800 transition-all group"
                >
                    <!-- Wrapper Gambar -->
                    <div class="relative aspect-square w-full overflow-hidden border-b border-gray-900/80">
                        <img :src="sample.image" class="w-full h-full object-cover group-hover:scale-105 duration-500">
                        
                        <!-- Overlay Tombol Play (Mobile: Selalu Terlihat Mini, Desktop: Hover Efek Besar) -->
                        <div class="absolute inset-0 bg-black/30 lg:bg-black/40 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button 
                                @click="togglePreview(sample)"
                                class="w-12 h-12 lg:w-14 lg:h-14 bg-emerald-500 text-black rounded-full flex items-center justify-center shadow-lg transform lg:translate-y-4 lg:group-hover:translate-y-0 duration-300 hover:scale-110 active:scale-95 focus:outline-none"
                            >
                                <component :is="currentPlayingId === sample.id && isPlaying ? Pause : Play" :size="16" class="fill-current stroke-2" />
                            </button>
                        </div>

                        <!-- Tag Kategori -->
                        <span class="absolute top-3 left-3 bg-black/70 backdrop-blur-md text-gray-400 border border-gray-800 px-2 py-0.5 rounded text-[9px] font-bold tracking-wider uppercase">
                            {{ sample.category }}
                        </span>
                    </div>

                    <!-- Informasi Detail -->
                    <div class="p-4 md:p-5 space-y-3.5">
                        <div>
                            <h3 class="text-sm md:text-base font-bold text-gray-200 truncate group-hover:text-emerald-400 transition-colors">
                                {{ sample.title }}
                            </h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">by {{ sample.creator }}</p>
                        </div>

                        <div class="flex justify-between items-center pt-2 border-t border-gray-900/40">
                            <!-- Label Token -->
                            <div class="flex items-center gap-1 text-emerald-400 font-black text-xs bg-emerald-950/40 border border-emerald-900/30 px-2.5 py-1 rounded-xl">
                                <Coins :size="12" />
                                {{ sample.token }}<span class="text-[9px] font-medium text-gray-500">TK</span>
                            </div>

                            <!-- Tombol Beli -->
                            <button class="inline-flex items-center gap-1 bg-white text-black hover:bg-emerald-400 px-3 py-1.5 rounded-xl text-xs font-bold transition-all focus:outline-none">
                                <ShoppingBag :size="11" />
                                Buy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kondisi Kosong -->
            <div v-else class="text-center py-16 border border-dashed border-gray-900/80 rounded-2xl bg-[#111317]/10">
                <Music :size="32" class="mx-auto text-gray-700 mb-2 animate-bounce" />
                <h3 class="text-xs font-bold text-gray-400">Sample Tidak Ditemukan</h3>
            </div>

            <!-- ================= STICKY AUDIO PLAYER (Aman di Layar HP) ================= -->
            <transition name="slide-up">
                <div 
                    v-if="activeSample" 
                    class="fixed bottom-4 left-4 right-4 md:left-auto md:right-6 md:w-[360px] bg-[#111317]/95 border border-emerald-500/20 shadow-2xl rounded-xl md:rounded-2xl p-3 md:p-4 backdrop-blur-xl z-50 flex items-center justify-between gap-3"
                >
                    <div class="flex items-center gap-2.5 min-w-0">
                        <img :src="activeSample.image" class="w-10 h-10 md:w-11 md:h-11 rounded-lg object-cover border border-gray-800 flex-shrink-0" :class="isPlaying ? 'animate-spin' : ''" style="animation-duration: 6s" />
                        <div class="min-w-0">
                            <p class="text-[9px] uppercase font-bold text-emerald-400 flex items-center gap-1">
                                <Volume2 :size="9" /> Previewing
                            </p>
                            <h4 class="text-xs font-bold text-white truncate mt-0.5">{{ activeSample.title }}</h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        <button @click="isPlaying = !isPlaying" class="w-8 h-8 bg-white text-black hover:bg-emerald-400 rounded-full flex items-center justify-center transition-all focus:outline-none">
                            <component :is="isPlaying ? Pause : Play" :size="12" class="fill-current" />
                        </button>
                        <button @click="activeSample = null; currentPlayingId = null; isPlaying = false" class="text-gray-500 hover:text-white text-xs px-1.5 py-1 focus:outline-none">
                            ✕
                        </button>
                    </div>

                    <audio v-if="activeSample" :src="activeSample.audioUrl" v-show="false" v-audio-control="isPlaying"></audio>
                </div>
            </transition>

        </div>
    </AppLayout>
</template>

<style scoped>
/* Menghilangkan scrollbar default bawaan browser pada navigasi kategori mobile */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

.slide-up-enter-active, .slide-up-leave-active { transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1); }
.slide-up-enter-from, .slide-up-leave-to { transform: translateY(24px); opacity: 0; }
</style>