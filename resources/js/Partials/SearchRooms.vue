<template>
    <div class="main-search-screen">
        <div class="content-container main-search-screen__search">
            <div class="main-search">
                <div class="main-search__title">
                    Бронирование
                </div>

                <div class="main-search__form">
                    <RoomSearchForm />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import RoomSearchForm from "../Components/RoomSearchForm.vue";
</script>
