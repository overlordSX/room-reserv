<template>
    <VueFinalModal class="">
        <div class="add-new-load-popup">
            <div class="page__section-title">Форма редактирования</div>

            <form class="add-hotel-form" @submit.prevent="submit">
                <div class="add-hotel-form__item">
                    <InputLabel for="phone" value="Номер телефона клиента"/>

                    <!-- todo multiselect, с группировками (полное имя - группа, в Items - его номер), в который подтягивается 5-10 последних клиентов -->
                    <TextInput
                        id="phone"
                        type="text"
                        v-model="form.phone"
                        placeholder="89876543210"
                        autocomplete="off"
                        required
                        autofocus
                        :is-green="true"
                    />

                    <InputError v-if="form.errors.phone" :message="form.errors.phone"/>
                </div>

                <div class="add-hotel-form__item">
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

                <div class="add-hotel-form__item">
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

                <div class="form__footer">
                    <button class="btn"
                            :disabled="form.processing">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </VueFinalModal>
</template>

<script setup lang="ts">
import {VueFinalModal, useModal} from "vue-final-modal";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputNumber from "@/Components/InputNumber.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {TRoomWithLoad} from "@/types/TRoomWithLoad";
import AddNewClient from "@/Components/AddNewClient.vue";
import {ref} from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import {datePickerDefaultSettings} from "@/helpers/consts";
import {startDateAddDays} from "@/helpers/common";
import {TRoomLoad} from "@/types/TRoomLoad";

const props = defineProps<{
    item: TRoomWithLoad,
    load: TRoomLoad,
}>();

const incomeDate = ref<Date>(new Date(props.load.startDate));
const outcomeDate = ref<Date>(new Date(props.load.endDate));

const datePickerDate = ref([incomeDate.value, outcomeDate.value])

const datePickerSettings = {
    ...datePickerDefaultSettings,
    timePicker: false,
    range: true,
    modelType: 'timestamp',
}

const form = useForm({
    phone: props.load.phone,
    countOfGuests: props.load.people,
    dateIncome: incomeDate.value.toISOString(),
    dateOutcome: outcomeDate.value.toISOString(),
    roomId: props.item.id,
    hotelId: props.item.hotelId,
    loadId: props.load.id,
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

const emit = defineEmits<{
    (e: 'confirm'): void
}>()

const submit = () => {
    form.post(route('dashboard.room.update-load', { room: props.item.id}), {
        onSuccess: () => emit('confirm'),
    });
};

</script>
