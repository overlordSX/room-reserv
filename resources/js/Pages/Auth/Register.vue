<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form class="form" @submit.prevent="submit">
            <div class="form__item">
                <InputLabel for="name" value="Имя" />

                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="off"
                />

                <InputError :message="form.errors.name" />
            </div>

            <div class="form__item">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="off"
                />

                <InputError :message="form.errors.email" />
            </div>

            <div class="form__item">
                <InputLabel for="password" value="Пароль" />

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="off"
                />

                <InputError :message="form.errors.password" />
            </div>

            <div class="form__item">
                <InputLabel for="password_confirmation" value="Повторите пароль" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="off"
                />

                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="form__footer">
                <button
                    class="btn btn--clear-white"
                    :class="{'btn--disabled': form.processing}"
                >
                    Зарегистрироваться
                </button>

                <Link :href="route('login')" class="link link--uline">
                    Уже зарегистрированы?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
