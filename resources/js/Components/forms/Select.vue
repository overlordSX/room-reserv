<template>
    <Multiselect v-model="localValue"
                 v-bind="settings"
                 :options="valueOptions"
                 :canDeselect="true"
    >
    </Multiselect>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import Multiselect from '@vueform/multiselect';
import {TFormValueOption} from "@/types/TFormValueOption";

// @ts-ignore
const props = withDefaults(defineProps<{
    modelValue: any,
    valueOptions: Array<TFormValueOption>,
    placeholder: string,
    isRequired?: boolean,
    mode?: string,
}>(), {
    isRequired: true,
    mode: 'single',
});

const settings = {
    placeholder: props.placeholder,
    noOptionsText: 'Список пуст',
    noResultsText: 'Элементы не&nbsp;найдены',
    groupLabel: 'Выбраны',
    mode: props.mode,
    hideSelected: true,
    closeOnSelect: true,
    canClear: props.isRequired,
    multipleLabel: values => `${values.length} выбран`
};

const localValue = ref(props.modelValue);

const emit = defineEmits(['update:model-value']);

watch(props, (newProps) => {
    localValue.value = newProps.modelValue;
});

watch(localValue, (newValue) => {
    emit('update:model-value', newValue);
});

</script>
