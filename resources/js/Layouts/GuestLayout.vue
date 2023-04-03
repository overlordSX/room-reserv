<template wrapper-template>
    <Head title="title"/>

    <div class="page__wrapper">
        <GuestHeader></GuestHeader>
        <div class="guest-layout">
            <div class="guest-layout__form">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import {Link, Head} from '@inertiajs/vue3';
import GuestHeader from "@/Layouts/GuestHeader.vue";
</script>
