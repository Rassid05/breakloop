<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold">
            Admin Dashboard
        </h1>

        <p class="mt-3">
            Selamat datang di BreakLoop Admin
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