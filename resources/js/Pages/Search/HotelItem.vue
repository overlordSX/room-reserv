<template>
    <!-- todo вомзожно не нужен  -->
    <div class="hotel-list-item">
        <div class="hotel-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="hotel-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="hotel-list-item__placeholder">
                <PicturePlaceholderSvg />
            </div>

        </div>

        <div class="hotel-list-item__info">
            <div class="hotel-list-item__name-stars">
                <div class="hotel-list-item__name">
                    {{ item.name }}
                </div>

                <div class="hotel-list-item__stars">
                    <span class="hotel-list-item__stars-count">
                        {{ item.countOfStars }}
                    </span> {{ plural(['здвезда', 'звезды', 'звезд'], item.countOfStars) }}
                </div>
            </div>

            <div v-if="item.countOfRooms" class="hotel-list-item__count-rooms">
                {{ item.countOfRooms }} {{ plural(['номер', 'номера', 'номеров'], item.countOfRooms) }}
            </div>

            <div class="hotel-list-item__address">
                Адрес: <span v-html="item.address" />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">


import {THotel} from "@/types/THotel";
import {Link} from "@inertiajs/vue3";
import {plural} from "@/helpers/common";
import PicturePlaceholderSvg from "@/Components/PicturePlaceholderSvg.vue";

const props = defineProps<{
    item: THotel,
}>();
</script>
