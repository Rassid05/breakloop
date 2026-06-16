<template>
  <div class="flex items-center justify-between py-1">
    <div class="flex items-center gap-3">
      <img :src="image" class="w-9 h-9 rounded-full object-cover" />
      <div>
        <h4 class="text-xs font-bold text-white">{{ name }}</h4>
        <p class="text-[10px] text-gray-500">{{ followers }} Followers</p>
      </div>
    </div>
    <button class="bg-[#181a1f] hover:bg-gray-800 text-gray-300 text-[10px] font-semibold px-4 py-1.5 rounded-full border border-gray-800 transition">
      Follow
    </button>
  </div>
</template>

<script setup>
defineProps({
  name: String,
  followers: String,
  image: String
})
</script>