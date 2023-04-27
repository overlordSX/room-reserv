<template>
    <Base title="Админка тип">
        <template #full-page>
            <div class="calendar-board">
                <div class="calendar-board__nav">
                    <div class="calendar-board__title">Планировщик</div>

                    <div class="select-hotel">
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
                    <div class="rooms-calendar">
                        <div class="rooms-calendar__rooms-column">
                            <div class="rooms-calendar__room">
                                Номер 1
                            </div>
                            <div class="rooms-calendar__room">
                                Номер 2
                            </div>
                        </div>
                        <div class="rooms-calendar__dates">
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    8 суббота
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    9 воскресеньк
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    10 понедельник
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    11 вторник
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    12 понедельник
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    13 понедельник
                                </div>
                            </div>
                            <div class="rooms-calendar__date">
                                <div class="rooms-calendar__date-header">
                                    14 понедельник
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup>
import Base from "@/Layouts/Base.vue";
import {Head} from '@inertiajs/vue3';
</script>
