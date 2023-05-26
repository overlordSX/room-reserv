
<template>
<!--    todo select-->
    <Multiselect v-model="localValue"
                 v-bind="settings"
                 :options="field.valueOptions"
                 :canDeselect="!field.attrs?.required && !field.attrs?.multiple"
                 :class="{'multiple': field.attrs?.multiple}"
    >
<!--        <template #caret>
            <span class="multiselect-arrow"
                  aria-hidden="true"
            >
                <SvgSymbol name="dropdown" />
            </span>
        </template>-->
    </Multiselect>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';
import Multiselect from '@vueform/multiselect';

const props = defineProps<{
    modelValue: any,
    // field: TField,
}>();

// const mode =  props.field?.attrs?.multiple ? 'multiple' : 'single';
//
// const settings = {
//     ...props.field?.attrs,
//     noOptionsText: 'Список пуст',
//     noResultsText: 'Элементы не&nbsp;найдены',
//     mode: mode,
//     hideSelected: !props.field?.attrs?.multiple,
//     closeOnSelect: !props.field?.attrs?.multiple,
//     canClear: !props.field?.attrs?.required,
// };

const mode = 'single';

const localValue = ref(props.modelValue);

const emit = defineEmits(['update:model-value']);

watch(props, (newProps) => {
    localValue.value = newProps.modelValue;
});

watch(localValue, (newValue) => {
    emit('update:model-value', newValue);
});

</script>
