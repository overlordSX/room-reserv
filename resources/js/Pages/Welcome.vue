<template>
    <Head title="Hello, world" />

    <div class="main-page">
        <span class="hello__text">
            hello, world
        </span>
    </div>

    <!-- пример использования роутов laravel
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    -->
</template>

<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
</script>
