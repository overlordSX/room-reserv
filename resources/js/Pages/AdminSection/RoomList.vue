<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader/>
        </template>

        <template #default>
            <div class="room-list page__section">
                <div class="room-list__actions">
                    <Link
                        :href="route('dashboard.hotels-list')"
                        class="btn room-list__back-btn">
                        К списку отелей
                    </Link>

                    <div class="room-list__controls">
                        <Link :href="route('dashboard.hotel.edit', {hotel: hotelId})" class="btn btn--blue">
                            Редактировать отель
                        </Link>

                        <button class="btn btn--red" @click="deleteHotel()">Удалить отель</button>
                    </div>
                </div>

                <div class="room-list__header">
                    <div class="room-list__title page__section-title">
                        Номера
                    </div>
                </div>

                <div class="room-list__list">
                    <RoomItem
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                        class="room-list__item room-list-item"
                    />
                </div>

                <div class="room-list__add-new">
                    <Link
                        :href="route('dashboard.hotels-list.rooms-list.add', hotelId)"
                        class="room-list__plus"/>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link, router} from "@inertiajs/vue3";
import RoomItem from "@/Pages/AdminSection/RoomItem.vue";
import {TRoom} from "@/types/TRoom";

// @ts-ignore
const props = withDefaults(defineProps<{
    items?: TRoom[],
    hotelId: number,
}>(), {
    items: () => [],
});

function deleteHotel() {
    if (confirm('Вы уверены? При удалении отеля связанные с ним номера и броинрования будут удалены.')) {
        router.post(route('dashboard.hotel.delete', {'hotel': props.hotelId}),);
    }
}
</script>
