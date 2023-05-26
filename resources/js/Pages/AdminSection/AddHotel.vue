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
                        Новый отель
                    </div>
                </div>

                <div class="add-hotel__form">
                    а тут формочка
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import Base from "@/Layouts/Base.vue";
import {Link} from "@inertiajs/vue3";
</script>
