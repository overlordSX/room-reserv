<template>
    <VueFinalModal class="">
        <div class="show-load-popup">
            <div class="page__section-title">
                Бронь <span v-if="!load.isApproved" class="show-load-popup__not-approved">(не подтвержденная)</span>
            </div>

            <div class="show-load-popup__info">
                <div
                    :key="load.name"
                    class="show-load-popup__client-name">
                    {{ load.name }}
                </div>

                <div
                    :key="load.phone"
                    class="show-load-popup__client-phone">
                    Номер: {{ load.phone }}
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
                <button v-if="!load.isApproved" class="show-load-popup__approve-btn btn" @click="approveReservation()">
                    Подтвердить
                </button>

                <div class="show-load-popup__btn-group">
                    <button class="show-load-popup__btn btn btn--blue" @click="() => open()">Редактировать</button>
                    <button class="show-load-popup__btn btn btn--red" @click="deleteReservation()">Удалить</button>
                </div>
            </div>
        </div>
    </VueFinalModal>
</template>

<script setup lang="ts">
import {VueFinalModal, useModal} from "vue-final-modal";
import {router} from "@inertiajs/vue3";
import {TRoomWithLoad} from "@/types/TRoomWithLoad";
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
            {
                onSuccess: () => emit('confirm'),
            });
    }
}

function approveReservation() {
    if (confirm('Вы подтвердили бронирование?')) {
        router.post(
            route('dashboard.room.approve-load'),
            {'loadId': props.load.id},
            {
                onSuccess: () => emit('confirm'),
            });
    }
}

</script>
