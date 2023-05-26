<template class="wrapper-template">
    <Head :title="title"/>
    <div class="page__wrapper">
        <slot name="header">
            <Header :can-register="canRegister" :can-login="canLogin" />
        </slot>
        <div class="page__content">
            <slot name="full-page">
                <div class="content-container">
                    <slot></slot>
                </div>
            </slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import Header from "@/Layouts/Header.vue";

type TComponentProps = {
    title: string,
    canLogin?: boolean;
    canRegister?: boolean;
};

const props = defineProps<TComponentProps>();
</script>
