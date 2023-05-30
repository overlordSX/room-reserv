<template>
    <VueFinalModal
        class="confirm-modal"
        content-class="confirm-modal-content"
        overlay-transition="vfm-fade"
        content-transition="vfm-fade"
    >
        <h1>{{ title }}</h1>
        <slot></slot>
        <button @click="emit('confirm')">
            hi
        </button>
    </VueFinalModal>
</template>

<script setup lang="ts">
import {VueFinalModal} from 'vue-final-modal'

defineProps<{
    title?: string
}>();

const emit = defineEmits<{
    (e: 'confirm'): void
}>();
</script>
