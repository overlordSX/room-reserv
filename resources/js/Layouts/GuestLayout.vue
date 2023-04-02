<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="guest-layout">
        <div class="guest-layout__return-header">
            <Link href="/" class="link">На главную</Link>
        </div>

        <div class="guest-layout__form">
            <slot />
        </div>
    </div>
</template>
