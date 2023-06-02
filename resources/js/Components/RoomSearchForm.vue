<template>
    <form class="form main-search-form" @submit.prevent="submit">
        <div class="main-search-form__fields">
            <div class="form__item">
                <InputLabel for="hotel" value="Отель"/>

                <Select
                    v-model="form.hotel"
                    placeholder="Выберите отель из списка"
                    :value-options="hotelsMin"
                    :mode="'multiple'"
                    :selected-plural="['отель', 'отеля', 'отелей']"
                />

                <InputError v-if="form.errors.hotel" :message="form.errors.hotel"/>
            </div>

            <div class="form__item">
                <InputLabel for="dates" value="Даты заезда и выезда"/>

                <VueDatePicker
                    v-model="datePickerDate"
                    v-bind="datePickerSettings"
                    @update:model-value="setDateRange"
                    @internal-model-change="setDateRange"
                >
                </VueDatePicker>

                <InputError v-if="form.errors.dateIncome" :message="form.errors.dateIncome"/>
                <InputError v-if="form.errors.dateOutcome" :message="form.errors.dateOutcome"/>
            </div>

            <div class="form__item">
                <InputLabel for="countOfGuests" value="Количество гостей"/>

                <InputNumber
                    id="countOfGuests"
                    v-model="form.countOfGuests"
                    placeholder="2"
                    autocomplete="off"
                    required
                    min="1"
                    max="50"
                />

                <InputError v-if="form.errors.countOfGuests" :message="form.errors.countOfGuests"/>
            </div>

            <div class="main-search-form__btn-wrapper">
                <button class="main-search-form__btn btn btn--clear-white">
                    Найти номер
                </button>
            </div>
        </div>
    </form>
</template>


<script setup lang="ts">
import InputError from '../Components/InputError.vue';
import InputLabel from '../Components/InputLabel.vue';
import {router, useForm} from '@inertiajs/vue3';
import {datePickerDefaultSettings} from "@/helpers/consts";
import {ref} from "vue";
import {startDateAddDays} from "@/helpers/common";
import VueDatePicker from "@vuepic/vue-datepicker";
import InputNumber from "@/Components/InputNumber.vue";
import Select from "@/Components/forms/Select.vue";
import {TFormValueOption} from "@/types/TFormValueOption";
//todo инвертировать инпуты и кнопку, кнопка белая, инпуты прозранчые

const props = defineProps<{
    hotelsMin: Array<TFormValueOption>,
}>();

const hotelFilterIdLocal = ref<number[] | null>([]);

const datePickerSettings = {
    ...datePickerDefaultSettings,
    timePicker: false,
    range: true,
    modelType: 'timestamp',
}

const incomeDate = ref<Date>(new Date());
const outcomeDate = ref<Date>(startDateAddDays(incomeDate.value, 1));

const datePickerDate = ref([incomeDate.value, outcomeDate.value])

const form = useForm({
    hotel: hotelFilterIdLocal.value,
    dateIncome: incomeDate.value.toISOString(),
    dateOutcome: outcomeDate.value.toISOString(),
    countOfGuests: 1,

});

function setDateRange(modelData) {
    if (modelData[0]) {
        incomeDate.value = new Date(modelData[0]);
        form.dateIncome = incomeDate.value.toISOString();
    }

    if (modelData[1]) {
        outcomeDate.value = new Date(modelData[1]);
        form.dateOutcome = outcomeDate.value.toISOString();
    }
}

const submit = () => {
    let filterData = {'startDate': form.dateIncome, 'endDate': form.dateOutcome, 'hotelsIds': form.hotel, 'countOfGuests': form.countOfGuests}

    router.get(route('search'), filterData, {preserveState: true});
};
</script>
