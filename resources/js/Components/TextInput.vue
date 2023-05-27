<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="input"
        :class="{'input--green-border': isGreen}"
        :autocomplete="autocomplete"
        ref="input"
    />
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';

type TComponentProps = {
    modelValue: any,
    isGreen?: boolean,
    autocomplete?: boolean,
}

const props = withDefaults(defineProps<TComponentProps>(), {
    modelValue: {type: String, required: true,},
    isGreen: false,
    autocomplete: false,
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
