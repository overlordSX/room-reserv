<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader/>
        </template>

        <template #default>
            <div class="hotel-list page__section">
                <Link
                    :href="route('dashboard.hotels-list')"
                    class="btn">
                    К списку отелей
                </Link>

                <div class="hotel-list__header">
                    <div class="hotel-list__title page__section-title">
                        Номера
                    </div>
                </div>

                <div class="hotel-list__list">
                    <RoomItem
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                        class="hotel-list__item hotel-list-item"
                    />
                </div>

                <div class="hotel-list__add-new">
                    <Link
                        :href="route('dashboard.hotels-list.rooms-list.add', hotelId)"
                        class="hotel-list__plus" />
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import RoomItem from "@/Pages/AdminSection/RoomItem.vue";
import {TRoom} from "@/types/TRoom";

const props = withDefaults(defineProps<{
    items?: TRoom[],
    hotelId: number,
}>(), {
    items: () => [],
});
</script>
