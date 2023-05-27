<template>
    <input
        type="number"
        class="input-number"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
</template>

<script setup lang="ts">
import {ref} from 'vue';

type TComponentProps = {
    modelValue: any,
}

const props = withDefaults(defineProps<TComponentProps>(), {
    modelValue: '',
    step: 1,
});

const emit = defineEmits(['update:modelValue']);

const input = ref<HTMLInputElement | null>(null);
</script>
