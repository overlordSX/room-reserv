<template class="wrapper-template">
    <Head :title="title"/>
    <div class="page__wrapper">
        <Header/>
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
};

const props = defineProps<TComponentProps>();
</script>
