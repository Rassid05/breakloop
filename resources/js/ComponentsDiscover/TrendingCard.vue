<template>
  <div class="relative group overflow-hidden rounded-2xl aspect-[4/5] cursor-pointer bg-gradient-to-b from-gray-700 to-black">
    <img :src="image" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition duration-500" />
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent p-4 flex flex-col justify-end">
      <h3 class="text-sm font-bold text-white mb-0.5">{{ title }}</h3>
      <p class="text-[10px] text-gray-300 mb-2">{{ count }} songs</p>
      
      <span class="w-7 h-7 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-xs text-white opacity-0 group-hover:opacity-100 transition duration-300 self-end">▶</span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  count: [Number, String],
  image: String
})
</script>