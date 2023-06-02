<template>
    <!-- todo тоже возможно не нужен -->
    <Base title="Админка тип">
        <template #default>
            <div class="hotel-list page__section">
                <div class="hotel-list__header">
                    <div class="hotel-list__title page__section-title">
                        Найденные отели
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
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import {THotel} from "@/types/THotel";
import HotelItem from "@/Pages/Search/HotelItem.vue";

// @ts-ignore
const props = withDefaults(defineProps<{items: THotel[]}>(), {
    items: () => [],
});
</script>
