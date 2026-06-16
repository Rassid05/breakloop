<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>

<AppLayout>

    <h1 class="text-4xl font-bold">
        Artist Dashboard
    </h1>

    <p class="mt-2 text-gray-400">
        Kelola lagu dan statistik musik Anda
    </p>

    <div class="grid grid-cols-4 gap-5 mt-10">

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Total Lagu</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Total Play</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Monthly Listener</h3>
            <p class="text-3xl font-bold mt-2">0</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-5">
            <h3>Status Premium</h3>
            <p class="text-3xl font-bold mt-2 text-green-500">
                Active
            </p>
        </div>

    </div>

</AppLayout>

</template>