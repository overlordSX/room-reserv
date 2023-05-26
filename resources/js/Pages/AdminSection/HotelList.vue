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

                </div>

                <div class="hotel-list__add-new">
                    <Link
                        :href="route('dashboard.hotels-list.add')"
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
</script>
