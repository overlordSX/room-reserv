<template>
    <div class="room-list-item__price price">
        <span class="price__value">{{formatPrice(value)}}</span>
        <span class="price__unit" v-html="unit"></span>
    </div>
</template>

<script setup lang="ts">
import formatPrice from "@/helpers/price";

const props = withDefaults(defineProps<{
    unit: string,
    value: number,
}>(), {
    unit: '&#8381;',
});
</script>
