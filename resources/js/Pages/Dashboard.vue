<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Dashboard</h2>
        </template>

        <div class="">
            <div class="">
                <div class="">
                    <div class="">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
