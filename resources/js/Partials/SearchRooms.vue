<template>
    <div class="main-search-screen">
        <div class="content-container main-search-screen__search">
            <div class="main-search">
                <div class="main-search__title">
                    Бронирование
                </div>

                <div class="main-search__form">
                    <RoomSearchForm :hotelsMin="hotelsMin"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import RoomSearchForm from "../Components/RoomSearchForm.vue";
import {TFormValueOption} from "@/types/TFormValueOption";

type TComponentProps = {
    hotelsMin: Array<TFormValueOption>,
};

const props = defineProps<TComponentProps>();
</script>
