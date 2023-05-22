<template>
    <VueDatePicker v-bind="datePickerSettings">
    </VueDatePicker>
</template>

<script setup lang="ts">
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {datepickerDefaultSettings} from "../helpers/consts";
import {ref} from "vue";

const props = defineProps<{
    additionalSettings?: object
}>();

const datePickerSettings = ref({
    ...datepickerDefaultSettings,
    ...props.additionalSettings,
});

console.log(datePickerSettings.value);

</script>
