<template>
    <Base title="Админка тип">
        <template #default>
            <div class="room-list page__section">
                <Link
                    :href="route('main')"
                    class="btn">
                    На главную
                </Link>

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
                        :search-params="searchParams"
                        class="room-list__item room-list-item"
                    />
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
import RoomItem from "@/Pages/Search/RoomItem.vue";
import {TRoom} from "@/types/TRoom";
import {TSearchParams} from "@/types/TSearchParams";

// @ts-ignore
const props = withDefaults(defineProps<{
    items?: TRoom[],
    searchParams: TSearchParams,
}>(), {
    items: () => [],
});
</script>
