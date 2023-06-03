<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="btn"
        type="file"
        ref="input"
    />
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';

type TComponentProps = {
    modelValue: any,
}

const props = withDefaults(defineProps<TComponentProps>(), {
    modelValue: '',
});

const emit = defineEmits(['update:modelValue']);

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({focus: () => input.value?.focus()});
</script>
