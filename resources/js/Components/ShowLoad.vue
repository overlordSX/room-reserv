<template>
    <VueFinalModal class="">
        <div class="show-load-popup">
            <div class="page__section-title">Бронь</div>

            <div class="show-load-popup__info">
                <div
                    :key="load.name"
                    class="show-load-popup__client-name">
                    {{ load.name }}
                </div>

                <div class="show-load-popup__dates">
                    Пребывает

                    <div
                        :key="load.startDate"
                        class="show-load-popup__start-date">
                        с {{ load.startDate }}
                    </div>

                    <div
                        :key="load.endDate"
                        class="show-load-popup__end-date">
                        по {{ load.endDate }}
                    </div>
                </div>

                <div
                    :key="load.people"
                    class="show-load-popup__peoples">
                    Количество гостей: {{ load.people }}
                </div>
            </div>

            <div class="show-load-popup__buttons">
                <button class="show-load-popup__btn btn" @click="() => open()">Редактировать</button>
                <button class="show-load-popup__btn btn btn--red" @click="deleteReservation()">Удалить</button>
            </div>
        </div>
    </VueFinalModal>
</template>

<script setup lang="ts">
import {VueFinalModal, useModal} from "vue-final-modal";
import {router, useForm} from "@inertiajs/vue3";
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
import EditLoad from "@/Components/EditLoad.vue";

const props = defineProps<{
    item: TRoomWithLoad,
    load: TRoomLoad,
}>();

// @ts-ignore
const {open, close} = useModal({
    component: EditLoad,
    attrs: {
        item: props.item,
        load: props.load,
        onConfirm() {
            close();
            emit('confirm');
        },
    },
})


const emit = defineEmits<{
    (e: 'confirm'): void
}>()

function deleteReservation() {
    if (confirm('Вы уверены?')) {
        router.post(
            route('dashboard.room.delete-load'),
            {'loadId': props.load.id},
            {onSuccess: emit('confirm'),
        });
    }
}

</script>
