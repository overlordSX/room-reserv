<template>
    <div class="room-list-item__price price">
        <span class="price__value">{{formatPrice(value)}}</span>
        <span class="price__unit" v-html="unit"></span>
    </div>
</template>

<script setup lang="ts">
import formatPrice from "@/helpers/price";

// @ts-ignore
const props = withDefaults(defineProps<{
    value: number,
    unit?: string,
}>(), {
    unit: '&#8381;',
});
</script>
