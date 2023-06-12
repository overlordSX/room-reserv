<template>
    <header class="page__header">
        <div class="header">
            <div class="content-container header__grid">
                <a href="/" class="header__logo link">
                    <ApplicationLogo />
                </a>

                <div class="header__nav header-nav">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Планировщик
                    </NavLink>

                    <NavLink :href="route('dashboard.hotels-list')" :active="$page.url.startsWith('/dashboard/hotels-list')">
                        Отели
                    </NavLink>

                    <Link :href="'logout'" method="post" class="link link--hover-uline">
                        Выйти
                    </Link>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>
