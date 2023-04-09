<template>
    <form class="form main-search-form" @submit.prevent="submit">
        <div class="main-search-form__fields">
            <div class="form__item">
                <InputLabel for="city" value="Город"/>

                <TextInput
                    id="city"
                    type="string"
                    v-model="form.city"
                    required
                    autocomplete="current-city"
                />
            </div>

            <div class="main-search-form__group-item">
                <div class="form__item">
                    <InputLabel for="date-income" value="Заезд"/>

                    <TextInput
                        id="date-income"
                        type="date"
                        v-model="form.income"
                        required
                    />
                </div>

                <div class="form__item">
                    <InputLabel for="date-outcome" value="Отъезд"/>

                    <TextInput
                        id="date-outcome"
                        type="date"
                        v-model="form.outcome"
                        required
                    />
                </div>
            </div>

            <div class="form__item">
                <InputLabel for="count-of-people" value="Количество человек"/>

                <TextInput
                    id="count-of-people"
                    type="string"
                    v-model="form.count"
                    required
                    autocomplete="2"
                />
            </div>

            <div class="main-search-form__btn-wrapper">
                <button class="main-search-form__btn btn btn--clear-white">
                    Найти номер
                </button>
            </div>
        </div>

        <div class="main-search-form__errors">
            <InputError :message="form.errors.city"/>
            <InputError :message="form.errors.income"/>
            <InputError :message="form.errors.outcome"/>
            <InputError :message="form.errors.count"/>
        </div>
    </form>
</template>


<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';
//todo инвертировать инпуты и кнопку, кнопка белая, инпуты прозранчые

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    city: 'Москва',
    income: '12 июня, вс',
    outcome: '14 июня, вт',
    count: '2 взрослых',

});

const submit = () => {
    /*form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });*/
};
</script>
