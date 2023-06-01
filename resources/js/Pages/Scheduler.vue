<template>
    <Base title="Админка тип">
        <template #header>
            <SchedulerHeader />
        </template>

        <template #full-page>
            <div class="calendar-board">
                <div class="calendar-board__nav">
                    <div class="calendar-board__title">Планировщик</div>

                    <div class="calendar-board__pick-date">
                        <VueDatePicker
                            v-model="datePickerDate"
                            v-bind="datePickerSettings"
                            @update:model-value="setDateRange"
                        >
                        </VueDatePicker>
                    </div>

                    <div class="calendar-board__select-hotel select-hotel">
                        <div class="select-hotel__title">
                            Выберите отель из списка
                        </div>
                        <div class="select-hotel__list">
                            <div class="select-hotel__item select-hotel__item--current">Отель 1</div>
                            <div class="select-hotel__item">Отель 2</div>
                            <div class="select-hotel__item">Отель 3</div>
                            <div class="select-hotel__item">Отель 4</div>
                            <div class="select-hotel__item">Отель 5</div>
                        </div>
                    </div>

                    <div class="select-hotel-room">
                        <div class="select-hotel-room__room">
                            <input name="checkbox" type="checkbox">
                            <label for="checkbox">Номер 1</label>
                        </div>

                        <div class="select-hotel-room__room">
                            <input name="checkbox" type="checkbox">
                            <label for="checkbox">Номер 2</label>
                        </div>

                        <div class="select-hotel-room__room">
                            <input name="checkbox" type="checkbox">
                            <label for="checkbox">Номер 3</label>
                        </div>

                        <div class="select-hotel-room__room">
                            <input name="checkbox" type="checkbox">
                            <label for="checkbox">Номер 4</label>
                        </div>
                    </div>
                </div>

                <div class="calendar-board__calendar rooms-calendar">
                    <div class="rooms-calendar__header">
                        <div class="rooms-calendar__nav">
                            <button class="btn btn--arrow" style="transform: scale(-1, 1);" @click="previousWeek()">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.75024 3.75001L12.0002 9L6.75024 14.25" stroke="#727650"
                                          stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <button class="btn btn--white btn--today-btn" @click="currentDay()">Сегодня</button>

                            <button class="btn btn--arrow" @click="nextWeek()">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.75024 3.75001L12.0002 9L6.75024 14.25" stroke="#727650"
                                          stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>

                        <div class="rooms-calendar__current-dates">
                            {{ fullDate(startDate) }}&nbsp;&mdash;
                            {{ fullDate(endDate) }}
                        </div>
                    </div>

                    <div class="rooms-calendar__list">
                        <div
                            class="rooms-calendar__row">
                            <div class="rooms-calendar__item room-calendar-item">
                                <div class="room-calendar-item__room-name"></div>

                                <div
                                    v-for="(item, index) in daysInterval"
                                    :key="index"
                                    class="room-calendar-item__date-header">
                                    {{ dateWithMonth(startDateAddDays(index)) }}
                                </div>
                            </div>
                        </div>

                        <div
                            v-for="(item, index) in items"
                            :key="item.id"
                            class="rooms-calendar__row">
                            <div class="rooms-calendar__item room-calendar-item">
                                <div class="room-calendar-item__room-name">{{ item.name }}</div>


                                <div
                                    v-for="load in getLoad(item.load)"
                                    :key="load.cellDate"
                                    class="room-calendar-item__day-load"
                                    :class="{'room-calendar-item__day-load--last-in-column': index + 1 === items.length}"
                                    :style="{'--long-duration-bg-color': load.bgColor}"
                                    @click="chooseAction(item, load)"
                                >
                                    <template v-if="load.people">
                                        <span class="room-calendar-item__cell-name" v-html="load.name"></span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Base>
    <ModalsContainer/>
</template>

<script setup lang="ts">
import Base from "@/Layouts/Base.vue";
import {ref} from "vue";
import {dateWithMonth, fullDate} from "@/helpers/dates";
import {TRoomLoad} from "@/types/TRoomLoad";
import VueDatePicker from "@vuepic/vue-datepicker";
import {datePickerDefaultSettings} from "@/helpers/consts";
import SchedulerHeader from "@/Layouts/SchedulerHeader.vue";
import {ModalsContainer, useModal} from "vue-final-modal";
import AddNewLoad from "@/Components/AddNewLoad.vue";
import {TRoomWithLoad} from "@/types/TRoomWithLoad";

type TComponentProps = {
    dateFrom?: string | Date,
    items: TRoomWithLoad[],
}

// как нибудь чекнуть обновления vue, мб пофиксят
// @ts-ignore
const props = withDefaults(defineProps<TComponentProps>(), {
    dateFrom: new Date(),
});

const daysInterval = ref<number>(7);

const startDate = ref<Date>(new Date(props.dateFrom));

const endDate = ref<Date>(startDateAddDays(daysInterval.value - 1));

const datePickerDate = ref([startDate.value, endDate.value])

const datePickerSettings = {
    ...datePickerDefaultSettings,
    timePicker: false,
    inline: true,
    range: true,
    autoApply: true,
    autoRange: daysInterval.value - 1,
    modelType: 'timestamp',
}

function setDateRange(modelData) {
    startDate.value = new Date(modelData[0]);
}

function startDateAddDays(cntDays: number) {
    let localDate = new Date(startDate.value);
    localDate.setDate(localDate.getDate() + cntDays);

    return localDate;
}

function getLoad(loads?: TRoomLoad[]): TRoomLoad[] {
    let loadAr = [];

    for (let i = 0; i < daysInterval.value; i++) {
        loadAr.push({
            cellDate: startDateAddDays(i),
        })
    }

    if (loads) {
        loads.forEach((load: TRoomLoad) => {
            let loadStartDate = new Date(load.startDate);
            let loadEndDate = new Date(load.endDate);

            if (loadStartDate < startDate.value && endDate > startDate.value) {
                loadStartDate = startDate.value;
            }

            if (loadEndDate >= endDate.value && startDate < endDate.value) {
                loadEndDate = startDateAddDays(daysInterval.value);
            }

            let dateDiffs = Math.abs(Math.floor((loadEndDate - loadStartDate) / (1000 * 60 * 60 * 24)));

            if (dateDiffs === 1) {
                load.bgColor = '#fff';
            }

            for (let i = 0; i < dateDiffs; i++) {
                loadAr.forEach((tempLoad: TRoomLoad, index: number) => {
                    if (tempLoad.cellDate) {
                        let cellDateObj = new Date(tempLoad.cellDate);
                        let localDate = new Date(loadStartDate);

                        localDate.setDate(localDate.getDate() + i);

                        if (cellDateObj.getTime() === localDate.getTime()) {
                            loadAr[index] = {...loadAr[index], ...load};
                        }
                    }
                });
            }
        });
    }

    return loadAr;
}

function currentDay() {
    let now = new Date();
    startDate.value = new Date(now.getFullYear(), now.getMonth(), now.getDate(), -1 * now.getTimezoneOffset() / 60);
    endDate.value = new Date(startDateAddDays(daysInterval.value - 1));
    datePickerDate.value = [startDate.value, endDate.value];
}

function previousWeek() {
    startDate.value = new Date(startDate.value.setDate(startDate.value.getDate() - daysInterval.value));
    endDate.value = new Date(startDateAddDays(daysInterval.value - 1));
    datePickerDate.value = [startDate.value, endDate.value];
}

function nextWeek() {
    startDate.value = new Date(startDate.value.setDate(startDate.value.getDate() + daysInterval.value));
    endDate.value = new Date(startDateAddDays(daysInterval.value - 1));
    datePickerDate.value = [startDate.value, endDate.value];
}

function chooseAction(item: TRoomWithLoad, load: TRoomLoad) {
    console.log(load);

    if (load.name === undefined) {
        // @ts-ignore
        const {open, close} = useModal({
            component: AddNewLoad,
            attrs: {
                item: item,
                startDate: load.cellDate,
                onConfirm() {
                    close();
                },
            },
        })

        open();
    }
}

</script>
