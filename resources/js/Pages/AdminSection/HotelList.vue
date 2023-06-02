<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader/>
        </template>

        <template #default>
            <div class="hotel-list page__section">
                <div class="hotel-list__header">
                    <div class="hotel-list__title page__section-title">
                        Ваши отели
                    </div>
                </div>

                <div class="hotel-list__list">
                    <HotelItem
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                        class="hotel-list__item hotel-list-item"
                    />
                </div>

                <div class="hotel-list__add-new">
                    <Link
                        :href="route('dashboard.hotels-list.add')"
                        class="hotel-list__plus plus" />
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import {THotel} from "@/types/THotel";
import HotelItem from "@/Pages/AdminSection/HotelItem.vue";

// @ts-ignore
const props = withDefaults(defineProps<{items: THotel[]}>(), {
    items: () => [],
});
</script>
