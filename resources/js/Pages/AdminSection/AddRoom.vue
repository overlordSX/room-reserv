<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader/>
        </template>

        <template #default>
            <div class="add-hotel page__section">
                <div class="add-hotel__navigation">
                    <Link
                        :href="route('dashboard.hotels-list')"
                        class="btn">
                        К списку отелей
                    </Link>

                    <Link
                        :href="route('dashboard.hotels-list.rooms-list', {hotel: hotelId})"
                        class="btn">
                        К списку номеров
                    </Link>
                </div>

                <div class="add-hotel__header">
                    <div class="add-hotel__title page__section-title">
                        <span v-if="isEdit && room?.name">Номер {{room.name}}</span>
                        <span v-else>Новый номер</span>
                    </div>
                </div>

                <div class="add-hotel__form">
                    <EditRoomForm v-if="isEdit && room" :room="room"/>
                    <AddRoomForm v-else :hotel-id="hotelId"/>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import AddRoomForm from "@/Pages/AdminSection/AddRoomForm.vue";
import {TRoom} from "@/types/TRoom";
import EditRoomForm from "@/Pages/AdminSection/EditRoomForm.vue";

const props = defineProps<{ hotelId: number, isEdit?: boolean, room?: TRoom}>();
</script>
