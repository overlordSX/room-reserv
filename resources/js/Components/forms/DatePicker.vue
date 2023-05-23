<template>
    <VueDatePicker v-bind="datePickerSettings">
    </VueDatePicker>
</template>

<script setup lang="ts">
import VueDatePicker from '@vuepic/vue-datepicker';
import {datePickerDefaultSettings} from "@/helpers/consts";
import {ref} from "vue";

const props = defineProps<{
    additionalSettings?: object
}>();

const datePickerSettings = ref({
    ...datePickerDefaultSettings,
    ...props.additionalSettings,
});

</script>
