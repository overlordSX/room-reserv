<template>
    <label class="input-label">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot/></span>
    </label>
</template>

<script setup lang="ts">
const props = defineProps<{
    value?: string,
}>();
</script>
