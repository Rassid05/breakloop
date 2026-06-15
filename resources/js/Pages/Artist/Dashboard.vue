<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold">
            Artist Dashboard
        </h1>

        <p class="mt-3">
            Kelola lagu dan statistik Anda
        </p>
    </div>

        <Link
        href="/logout"
        method="post"
        as="button"
        class="px-4 py-2 bg-red-500 text-white rounded"
    >
        Logout
    </Link>
</template>