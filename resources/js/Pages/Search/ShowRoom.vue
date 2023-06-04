<template>
    <Base title="Админка тип">
        <template #default>
            <div class="show-room-page page__section">
                <div class="show-room-page__links">
                    <Link
                        :href="route('search', {...searchParams})"
                        class="btn">
                        Назад
                    </Link>

                    <Link
                        :href="route('main')"
                        class="btn">
                        На главную
                    </Link>
                </div>

                <div class="show-room-page__content">
                    <div class="show-room-page__room show-room">
                        <div class="show-room__picture-wrapper">
                            <div v-if="item.photoUrl" class="show-room__picture">
                                <picture>
                                    <img :src="item.photoUrl" :alt="item.name">
                                </picture>
                            </div>

                            <div v-else class="show-room__placeholder">
                                <PicturePlaceholderSvg/>
                            </div>
                        </div>

                        <div class="show-room__description">
                            <div class="show-room__name">
                                {{ item.name }}
                            </div>

                            <div class="show-room__info-price">
                                <div class="show-room__info">
                                    <div class="show-room__count-of-beds">
                                        Количество комнат: {{ item.countOfRooms }} шт.
                                    </div>

                                    <div class="show-room__count-of-beds">
                                        Количество кроватей: {{ item.countOfBeds }} шт.
                                    </div>

                                    <div class="show-room__square">
                                        Площадь номера: {{ item.square }} м.кв.
                                    </div>
                                </div>

                                <div class="show-room__price-night">
                                    <Price :value="item.price * countOfDays"/>
                                    / {{ countOfDays + ' ' + plural(['ночь', 'ночи', 'ночей'], countOfDays) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show-room-page__form">
                        <form v-if="!isSendSuccess" class="add-hotel-form" @submit.prevent="submit">
                            <div class="add-hotel-form__group-item">
                                <div class="add-hotel-form__item">
                                    <InputLabel for="family" value="Фамилия"/>

                                    <TextInput
                                        id="family"
                                        type="text"
                                        v-model="form.family"
                                        placeholder="Иванов"
                                        autocomplete="off"
                                        required
                                        autofocus
                                        :is-green="true"
                                    />

                                    <InputError v-if="form.errors.family" :message="form.errors.family"/>
                                </div>

                                <div class="add-hotel-form__item">
                                    <InputLabel for="name" value="Имя"/>

                                    <TextInput
                                        id="name"
                                        type="text"
                                        v-model="form.name"
                                        placeholder="Иван"
                                        autocomplete="off"
                                        required
                                        :is-green="true"
                                    />

                                    <InputError v-if="form.errors.name" :message="form.errors.name"/>
                                </div>
                            </div>

                            <div class="add-hotel-form__group-item">
                                <div class="add-hotel-form__item">
                                    <InputLabel for="surname" value="Отчество"/>

                                    <TextInput
                                        id="surname"
                                        type="text"
                                        v-model="form.surname"
                                        placeholder="Иванович"
                                        autocomplete="off"
                                        :is-green="true"
                                    />

                                    <InputError v-if="form.errors.surname" :message="form.errors.surname"/>
                                </div>

                                <div class="add-hotel-form__item">
                                    <InputLabel for="phone" value="Номер телефона"/>

                                    <TextInput
                                        id="phone"
                                        type=""
                                        v-model="form.phone"
                                        placeholder="89998887766"
                                        autocomplete="off"
                                        required
                                        :is-green="true"
                                    />

                                    <InputError v-if="form.errors.phone" :message="form.errors.phone"/>
                                </div>
                            </div>

                            <div class="add-hotel-form__group-item">
                                <div class="add-hotel-form__item">
                                    <InputLabel for="email" value="Email"/>

                                    <TextInput
                                        id="email"
                                        type="text"
                                        v-model="form.email"
                                        placeholder="mail@mail.com"
                                        autocomplete="off"
                                        required
                                        :is-green="true"
                                    />

                                    <InputError v-if="form.errors.email" :message="form.errors.email"/>
                                </div>

                                <div class="add-hotel-form__item">
                                    <InputLabel for="countOfGuests" value="Количество гостей"/>

                                    <InputNumber
                                        id="countOfGuests"
                                        v-model="form.countOfGuests"
                                        placeholder="1"
                                        autocomplete="off"
                                        required
                                        min="1"
                                        :max="item.countOfBeds"
                                    />

                                    <InputError v-if="form.errors.countOfGuests" :message="form.errors.countOfGuests"/>
                                </div>
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
                                    Забронировать
                                </button>
                            </div>
                        </form>

                        <div v-else class="show-room-page__success-reserve">
                            Номер забронирован успешно.<br/>Вам перезвонят в ближайщее время, для подтверждения бронирования.
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import {Link, useForm} from "@inertiajs/vue3";
import Base from "@/Layouts/Base.vue";
import {TRoom} from "@/types/TRoom";
import {TSearchParams} from "@/types/TSearchParams";
import PicturePlaceholderSvg from "@/Components/PicturePlaceholderSvg.vue";
import Price from "@/Components/Price.vue";
import {plural} from "@/helpers/common";
import VueDatePicker from "@vuepic/vue-datepicker";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputNumber from "@/Components/InputNumber.vue";
import InputError from "@/Components/InputError.vue";
import {ref, computed} from "vue";
import {datePickerDefaultSettings} from "@/helpers/consts";

const props = defineProps<{
    item: TRoom,
    searchParams: TSearchParams,
}>();

const countOfDays = computed<number>(() => {
    let start = new Date(props.searchParams.startDate);
    let end = new Date(props.searchParams.endDate);

    return Math.abs(Math.floor((end - start) / (1000 * 60 * 60 * 24)));
});

const isSendSuccess = ref<boolean>(false);

const incomeDate = ref<Date>(new Date(props.searchParams.startDate));
const outcomeDate = ref<Date>(new Date(props.searchParams.endDate));

const datePickerDate = ref([incomeDate.value, outcomeDate.value])

const datePickerSettings = {
    ...datePickerDefaultSettings,
    timePicker: false,
    range: true,
    modelType: 'timestamp',
}

const form = useForm({
    name: '',
    family: '',
    surname: '',
    phone: '',
    email: '',
    roomId: props.item.id,
    countOfGuests: props.searchParams.countOfGuests,
    dateIncome: incomeDate.value.toISOString(),
    dateOutcome: outcomeDate.value.toISOString(),
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
    form.post(route('reservations.room.add-load', {room: props.item.id}), {
        onSuccess: () => {
            console.log('wasSuccess');
            isSendSuccess.value = true
        },
    });
}

</script>
