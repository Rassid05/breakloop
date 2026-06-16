<script setup>import { Home, Layers, Search, Library } from 'lucide-vue-next'; </script>
<template>
  <div class="h-screen bg-[#0b0c0e] text-gray-200 font-sans flex flex-col overflow-hidden select-none">
    
    <!-- Area Utama Dashboard -->
    <div class="flex flex-1 overflow-hidden h-full">
      
      <!-- Kolom Kiri: Sidebar (Hanya tampil di Tablet ke atas / MD) -->
      <div class="w-64 h-full flex-shrink-0 hidden md:block">
        <slot name="sidebar" />
      </div>

      <!-- Kolom Kanan: Gabungan Topbar + Konten Utama -->
      <div class="flex flex-1 flex-col h-full overflow-hidden">
        
        <!-- Topbar / Navbar (Menyesuaikan ukuran di Mobile) -->
        <div class="flex-shrink-0">
          <slot name="topbar" />
        </div>

        <!-- Grid Pembagi Konten Tengah dan Sidebar Kanan -->
        <div class="flex flex-1 overflow-hidden p-4 md:p-6 gap-6">
          
          <!-- AREA TENGAH: Bisa Di-scroll di semua perangkat -->
          <!-- Di mobile, kita beri padding bottom ekstra (pb-24) agar konten tidak tertutup player & nav bawah -->
          <div class="flex-[3] min-w-0 h-full overflow-y-auto pr-1 pb-24 md:pb-0 custom-scrollbar">
            <slot name="content" />
          </div>

          <!-- AREA KANAN: Featured & Popular (Hanya tampil di Desktop besar / XL) -->
          <div class="flex-[1] min-w-[300px] hidden xl:flex flex-col gap-6 h-full flex-shrink-0 overflow-hidden">
            <slot name="right-sidebar" />
          </div>

        </div>
      </div>
    </div>

<!-- Navigasi Bawah Khusus Mobile (Hanya tampil di bawah ukuran MD) -->
    <div class="md:hidden fixed bottom-[74px] left-0 right-0 bg-[#111317]/95 backdrop-blur-md border-t border-gray-900 flex justify-around py-2 z-50 px-4">
      <button class="flex flex-col items-center gap-1 text-emerald-500">
        <Home :size="18" />
        <span class="text-[9px] font-bold uppercase tracking-wider">Home</span>
      </button>
      <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition">
        <Layers :size="18" />
        <span class="text-[9px] font-bold uppercase tracking-wider">Samples</span>
      </button>
      <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition">
        <Search :size="18" />
        <span class="text-[9px] font-bold uppercase tracking-wider">Search</span>
      </button>
      <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-white transition">
        <Library :size="18" />
        <span class="text-[9px] font-bold uppercase tracking-wider">Library</span>
      </button>
    </div>

    <!-- Bottom Player Bar (Menyesuaikan diri di Mobile) -->
    <div class="flex-shrink-0 fixed bottom-0 left-0 right-0 md:relative z-50">
      <slot name="player" />
    </div>
  </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #23262d;
  border-radius: 9999px;
}
</style>