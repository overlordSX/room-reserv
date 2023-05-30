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
                        :href="route('dashboard.hotels-list.rooms-list', {id: hotelId})"
                        class="btn">
                        К списку номеров
                    </Link>
                </div>

                <div class="add-hotel__header">
                    <div class="add-hotel__title page__section-title">
                        Новый номер
                    </div>
                </div>

                <div class="add-hotel__form">
                    <AddRoomForm :hotel-id="hotelId"/>
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

const props = defineProps<{ hotelId: number }>();
</script>
