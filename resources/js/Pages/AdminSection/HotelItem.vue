<template>
    <div class="hotel-list-item">
        <div class="hotel-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="hotel-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="hotel-list-item__placeholder">
                <PicturePlaceholderSvg/>
            </div>

        </div>

        <div class="hotel-list-item__info">
            <div class="hotel-list-item__name-stars">
                <div class="hotel-list-item__name">
                    <a :href="route('dashboard.hotels-list.rooms-list', {id: item.id})" class="link link--hover-green">
                        {{ item.name }}
                    </a>
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
                Адрес: <span v-html="item.address"/>
            </div>
        </div>

        <div class="hotel-list-item__actions">
            <Link
                :href="route('dashboard.hotels-list.rooms-list.add', item.id)"
                class="hotel-list-item__btn btn"
            >Добавить номер
            </Link>

            <Link
                v-if="item.countOfRooms"
                :href="route('dashboard.hotels-list.rooms-list', {id: item.id})"
                class="hotel-list-item__btn btn"
            >Показать номера
            </Link>
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
