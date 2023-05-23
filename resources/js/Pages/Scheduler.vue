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

                <div class="calendar-board__calendar">
                    <div class="calendar-board__calendar-header">

                    </div>

                    <div class="rooms-calendar">
                        <div
                            class="rooms-calendar__row">
                            <div class="rooms-calendar__item room-calendar-item">
                                <div class="room-calendar-item__room-name"></div>

                                <div
                                    v-for="(item, index) in 7"
                                    :key="index"
                                    class="room-calendar-item__date-header">
                                    {{ startDateAddDays(index) }}
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
                                    v-for="client in item.load"
                                    :key="client.name"
                                    class="room-calendar-item__day-load"
                                    :class="{'room-calendar-item__day-load--last-in-column': index + 1 === items.length}"
                                >
                                    {{ client.name }} {{ client.people }} человек
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
import {ref} from "vue";
import {dateWithMonth} from "@/helpers/dates";

type TComponentProps = {
    dateFrom?: string,
    items: TSchedulerItem[],
};

const props = withDefaults(defineProps<TComponentProps>(), {
    dateFrom: '',
});


const startDate = ref<Date>(new Date(props.dateFrom));

function startDateAddDays(cntDays: number) {
    let localDate = startDate.value;

    localDate.setDate(localDate.getDate() + cntDays);

    return dateWithMonth(localDate);
}
</script>
