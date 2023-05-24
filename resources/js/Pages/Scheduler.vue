<template>
    <Base title="Админка тип">
        <template #full-page>
            <div class="calendar-board">
                <div class="calendar-board__nav">
                    <div class="calendar-board__title">Планировщик</div>

                    <div class="calendar-board__pick-date">
                        <DatePicker :additional-settings="{inline: true}"></DatePicker>
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
                    {{ startDate }}
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
                            {{ fullDate(startDateAddDays(daysInterval - 1)) }}
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
                                    v-for="client in getLoad(item.load)"
                                    :key="client.name"
                                    class="room-calendar-item__day-load"
                                    :class="{'room-calendar-item__day-load--last-in-column': index + 1 === items.length}"
                                    :style="{'--long-duration-bg-color': client.bgColor}"
                                >
                                    <template v-if="client.people">{{ client.name }}
                                        <!-- {{ client.people }} человек--></template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import Base from "@/Layouts/Base.vue";
import DatePicker from "@/Components/forms/DatePicker.vue";
import {TSchedulerItem} from "@/types/TSchedulerItem";
import {computed, ref} from "vue";
import {dateWithMonth, fullDate} from "@/helpers/dates";
import {TRoomLoad} from "@/types/TRoomLoad";

type TComponentProps = {
    dateFrom?: string | Date,
    items: TSchedulerItem[],
}

//todo почекать обновления vue, мб пофиксят
const props = withDefaults(defineProps<TComponentProps>(), {
    dateFrom: new Date(),
});

const daysInterval = ref<number>(7);


const startDate = ref<Date>(new Date(props.dateFrom));

/*const localItems = computed(() => {
    let ar = [];
    props.items.forEach((item) => {
        let localItem = item;
        item.load = getLoad(item.load);
        ar.push(localItem);
    })

    return ar;
})*/

function startDateAddDays(cntDays: number) {
    let localDate = new Date(startDate.value);

    localDate.setDate(localDate.getDate() + cntDays);

    return localDate;
}

function getLoad(loads: TRoomLoad[]): TRoomLoad[] {

    let loadAr = [];

    if (loads.length > 0) {
        loads.forEach((load: TRoomLoad, index: number) => {
            let loadStartDate = new Date(load.startDate);

            let dateDiffs = Math.floor((loadStartDate - startDate.value) / (1000 * 60 * 60 * 24));


            if (dateDiffs + load.duration !== 0 && (loadStartDate < startDate.value || loadStartDate > startDateAddDays(daysInterval.value - 1))) {
                return;
            }


            if (loadAr.length === 0 && loadStartDate > startDate.value) {
                for (let i = 0; i < dateDiffs; i++) {
                    loadAr.push([]);
                }
            }

            if (loadAr.length > 0 && index >= 1) {
                let previousLoad = loads[index - 1];
                let previousLoadDate = new Date(previousLoad.startDate);
                let diffsWithPrevious = Math.floor((loadStartDate - previousLoadDate) / (1000 * 60 * 60 * 24));

                if (diffsWithPrevious > 1 && load.duration === 1 && previousLoad.duration < diffsWithPrevious) {
                    for (let i = 0; i < diffsWithPrevious - previousLoad.duration; i++) {
                        loadAr.push([]);
                    }
                }
            }


            if (load.duration > 1) {
                load.bgColor = getRandomColor();
            }

            for (let i = 0; i < load.duration; i++) {
                loadAr.push(load);
            }
        });
    }

    if (loadAr.length !== daysInterval.value) {
        let diffs = daysInterval.value - loadAr.length;

        for (let i = 0; i < diffs; i++) {
            loadAr.push([]);
        }
    }

    return loadAr;
}

const longDurationColors = ref<string[]>([
    '#e8fcdb',
    '#EEF2CB',
    '#E6E9D1',
]);

function getRandomColor(): string {
    let rand = Math.floor(Math.random() * longDurationColors.value.length);

    return longDurationColors.value[rand];
}

function currentDay() {
    let now = new Date();
    startDate.value = new Date(now.getFullYear(), now.getMonth(), now.getDate(), -1 * now.getTimezoneOffset() / 60);
    console.log(startDate.value.toISOString());
}

function previousWeek() {
    startDate.value = new Date(startDate.value.setDate(startDate.value.getDate() - daysInterval.value));
}

function nextWeek() {
    startDate.value = new Date(startDate.value.setDate(startDate.value.getDate() + daysInterval.value));
}

</script>
