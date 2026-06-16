<template>
  <div class="bg-[#111317] p-3 rounded-2xl group cursor-pointer hover:bg-[#181a1f] border border-transparent hover:border-gray-800 transition duration-300">
    <div class="relative overflow-hidden rounded-xl mb-3 aspect-square">
      <img :src="image" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
      <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
        <button class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-black font-bold pl-0.5 shadow-lg shadow-emerald-500/30 transform translate-y-2 group-hover:translate-y-0 transition duration-300">▶</button>
      </div>
    </div>
    <h3 class="text-xs font-bold text-white truncate mb-0.5">{{ title }}</h3>
    <p class="text-[11px] text-gray-400 truncate">{{ artist }}</p>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  artist: String,
  image: String
})
</script>