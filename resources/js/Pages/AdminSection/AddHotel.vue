<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader/>
        </template>

        <template #default>
            <div class="add-hotel page__section">
                <Link
                    :href="route('dashboard.hotels-list')"
                    class="btn">
                    К списку отелей
                </Link>

                <div class="add-hotel__header">
                    <div class="add-hotel__title page__section-title">
                        <span v-if="isEdit && hotel?.name">Отель {{hotel.name}}</span>
                        <span v-else>Новый отель</span>
                    </div>
                </div>

                <div class="add-hotel__form">
                    <EditHotelForm v-if="isEdit && hotel" :hotel="hotel" />
                    <AddHotelForm v-else />
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import AddHotelForm from "@/Pages/AdminSection/AddHotelForm.vue";
import {THotel} from "@/types/THotel";
import EditHotelForm from "@/Pages/AdminSection/EditHotelForm.vue";

const props = defineProps<{isEdit?: boolean, hotel?: THotel}>();

</script>
