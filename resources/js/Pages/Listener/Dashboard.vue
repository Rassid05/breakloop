<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>

<AppLayout>

    <h1 class="text-4xl font-bold">
        Welcome to BreakLoop
    </h1>

    <p class="mt-2 text-gray-400">
        Streaming Remix & Breakbeat Music
    </p>

    <div class="grid grid-cols-4 gap-5 mt-10">

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Total Songs</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Favorites</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Playlists</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Tokens</h3>
            <p class="text-3xl font-bold mt-2">10</p>
        </div>

    </div>

</AppLayout>

</template>