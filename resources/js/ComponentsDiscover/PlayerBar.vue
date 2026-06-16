<template>
  <footer class="h-[74px] md:h-[90px] bg-[#111317]/95 backdrop-blur-md border-t border-gray-900 px-4 md:px-6 flex items-center justify-between w-full select-none">
    
    <!-- Bagian Kiri: Info Lagu Mini -->
    <div class="flex items-center gap-3 w-2/3 md:w-1/4">
      <img src="https://picsum.photos/50/50?random=11" class="w-9 h-9 md:w-11 md:h-11 rounded-lg object-cover flex-shrink-0 shadow-md" />
      <div class="min-w-0">
        <h4 class="text-xs md:text-sm font-semibold text-white truncate">Anjing Kacili</h4>
        <p class="text-[10px] md:text-xs text-gray-400 truncate">Bassgilano</p>
      </div>
      <button 
        @click="isLiked = !isLiked" 
        class="hover:scale-110 transition ml-2 flex-shrink-0 focus:outline-none"
      >
        <Heart 
          :class="isLiked ? 'text-red-500 fill-red-500' : 'text-gray-400 hover:text-white'" 
          :size="16" 
        />
      </button>
    </div>

    <!-- Bagian Tengah: Playback Controls & Progress Bar -->
    <div class="flex flex-col items-center gap-1.5 w-1/3 md:w-2/4 max-w-xl flex-shrink-0">
      <!-- Tombol Navigasi Musik -->
      <div class="flex items-center gap-4 md:gap-6">
        <button 
          @click="isShuffle = !isShuffle" 
          :class="isShuffle ? 'text-emerald-500' : 'text-gray-400 hover:text-white'" 
          class="transition hidden md:block"
        >
          <Shuffle :size="16" />
        </button>
        
        <button class="text-gray-400 hover:text-white transition hidden sm:block">
          <SkipBack :size="18" class="fill-current" />
        </button>
        
        <!-- Tombol Utama Play / Pause -->
        <button 
          @click="togglePlay" 
          class="w-9 h-9 md:w-10 md:h-10 bg-white text-black rounded-full flex items-center justify-center shadow-lg hover:scale-105 active:scale-95 transition"
        >
          <Play v-if="!isPlaying" :size="18" class="fill-black ml-0.5" />
          <Pause v-else :size="18" class="fill-black" />
        </button>
        
        <button class="text-gray-400 hover:text-white transition">
          <SkipForward :size="18" class="fill-current" />
        </button>
        
        <button 
          @click="isRepeat = !isRepeat" 
          :class="isRepeat ? 'text-emerald-500' : 'text-gray-400 hover:text-white'" 
          class="transition hidden md:block"
        >
          <Repeat :size="16" />
        </button>
      </div>
      
      <!-- Progress Bar Garis Waktu Musik -->
      <div class="w-full hidden md:flex items-center gap-3 text-[10px] text-gray-400 font-medium">
        <span>{{ formatTime(currentTime) }}</span>
        <div 
          @click="seekProgress"
          class="flex-1 h-1 bg-gray-800 rounded-full relative group cursor-pointer"
        >
          <!-- Progress Terisi -->
          <div 
            class="absolute top-0 left-0 h-full bg-emerald-500 rounded-full group-hover:bg-emerald-400 transition-all duration-100"
            :style="{ width: progressPercent + '%' }"
          ></div>
          <!-- Bulatan Slider (Hanya muncul saat hover) -->
          <div 
            class="absolute top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-white rounded-full hidden group-hover:block shadow"
            :style="{ left: progressPercent + '%' }"
          ></div>
        </div>
        <span>{{ formatTime(duration) }}</span>
      </div>
    </div>

    <!-- Bagian Kanan: Audio Utilities & Volume -->
    <div class="w-1/4 hidden md:flex items-center justify-end gap-4 text-gray-400">
      <button class="hover:text-white transition"><Tv :size="16" /></button>
      <button class="hover:text-white transition"><Mic2 :size="16" /></button>
      
      <!-- Kontrol Volume -->
      <div class="flex items-center gap-2 group/volume">
        <button @click="toggleMute" class="hover:text-white transition">
          <VolumeX v-if="volume === 0" :size="16" />
          <Volume1 v-else-if="volume < 50" :size="16" />
          <Volume2 v-else :size="16" />
        </button>
        <div 
          @click="changeVolume"
          class="w-20 h-1 bg-gray-800 rounded-full relative cursor-pointer"
        >
          <div 
            class="absolute top-0 left-0 h-full bg-gray-300 group-hover/volume:bg-emerald-500 rounded-full"
            :style="{ width: volume + '%' }"
          ></div>
        </div>
      </div>
      
      <button class="hover:text-white transition ml-1"><Maximize2 :size="14" /></button>
    </div>

  </footer>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { 
  Heart, Shuffle, SkipBack, Play, Pause, SkipForward, 
  Repeat, Tv, Mic2, Volume1, Volume2, VolumeX, Maximize2 
} from 'lucide-vue-next';

// State Fungsional Player
const isPlaying = ref(false);
const isLiked = ref(false);
const isShuffle = ref(false);
const isRepeat = ref(false);

const currentTime = ref(147); // Dalam detik (2:27)
const duration = ref(362);    // Dalam detik (6:02)
const volume = ref(75);       // Nilai persentase 0 - 100
const previousVolume = ref(75);

let timer = null;

// Menghitung persentase berjalannya lagu
const progressPercent = computed(() => {
  return (currentTime.value / duration.value) * 100;
});

// Format detik ke format waktu string (Menit:Detik)
const formatTime = (secs) => {
  const minutes = Math.floor(secs / 60);
  const seconds = Math.floor(secs % 60);
  return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
};

// Fungsi Play / Pause dengan simulasi berjalan
const togglePlay = () => {
  isPlaying.value = !isPlaying.value;
  if (isPlaying.value) {
    timer = setInterval(() => {
      if (currentTime.value < duration.value) {
        currentTime.value++;
      } else {
        if (isRepeat.value) {
          currentTime.value = 0;
        } else {
          isPlaying.value = false;
          clearInterval(timer);
        }
      }
    }, 1000);
  } else {
    clearInterval(timer);
  }
};

// Fungsi klik untuk melompati menit lagu (Seek Progress)
const seekProgress = (event) => {
  const rect = event.currentTarget.getBoundingClientRect();
  const clickX = event.clientX - rect.left;
  const width = rect.width;
  const newPercent = clickX / width;
  currentTime.value = Math.floor(newPercent * duration.value);
};

// Fungsi mengubah tingkat volume suara
const changeVolume = (event) => {
  const rect = event.currentTarget.getBoundingClientRect();
  const clickX = event.clientX - rect.left;
  const width = rect.width;
  let newVolume = Math.round((clickX / width) * 100);
  if (newVolume < 0) newVolume = 0;
  if (newVolume > 100) newVolume = 100;
  volume.value = newVolume;
};

// Fungsi Mute / Unmute
const toggleMute = () => {
  if (volume.value > 0) {
    previousVolume.value = volume.value;
    volume.value = 0;
  } else {
    volume.value = previousVolume.value;
  }
};

// Bersihkan interval ketika komponen dihancurkan
onUnmounted(() => {
  if (timer) clearInterval(timer);
});
</script>