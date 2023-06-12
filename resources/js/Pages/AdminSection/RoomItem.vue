<template>
    <div class="room-list-item">
        <div class="room-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="room-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="room-list-item__placeholder">
                <PicturePlaceholderSvg/>
            </div>

        </div>

        <div class="room-list-item__content">
            <div class="room-list-item__name">
                {{ item.name }}
            </div>

            <div class="room-list-item__info-price">
                <div class="room-list-item__info">
                    <div class="room-list-item__count-of-beds">
                        {{ item.countOfBeds }} {{ plural(['комната', 'комнаты', 'комнат'], item.countOfBeds) }}
                    </div>

                    <div class="room-list-item__count-of-beds">
                        {{ item.countOfBeds }} {{ plural(['кровать', 'кровати', 'кроватей'], item.countOfBeds) }}
                    </div>

                    <div class="room-list-item__square">
                        {{ item.square }} м.кв.
                    </div>
                </div>

                <div class="room-list-item__price-actions">
                    <div class="room-list-item__price-night">
                        <Price :value="item.price"/>
                        / ночь
                    </div>

                    <div class="room-list-item__actions">
                        <Link
                            :href="route('dashboard.room.edit', {room: item.id})"
                            class="btn btn--icon btn--blue">
                            <EditSvg/>
                        </Link>

                        <button class="btn btn--icon btn--red" @click="deleteRoom()">
                            <DeleteSvg/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import {Link, router} from "@inertiajs/vue3";
import {TRoom} from "@/types/TRoom";
import Price from "@/Components/Price.vue";
import {plural} from "@/helpers/common";
import PicturePlaceholderSvg from "@/Components/PicturePlaceholderSvg.vue";
import EditSvg from "@/Components/EditSvg.vue";
import DeleteSvg from "@/Components/DeleteSvg.vue";

const props = defineProps<{
    item: TRoom,
}>();

function deleteRoom() {
    if (confirm('Вы уверены? При удалении номера связанные с ним бронирования будут удалены.')) {
        router.post(route('dashboard.room.delete', {'room': props.item.id}),);
    }
}
</script>
