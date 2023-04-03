<template>
    <GuestLayout>
        <Head title="Вход"/>

        <div v-if="status">
            {{ status }}
        </div>

        <form class="form" @submit.prevent="submit">
            <div class="form__item">
                <InputLabel for="email" value="Email"/>

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError :message="form.errors.email"/>
            </div>

            <div class="form__item">
                <InputLabel for="password" value="Пароль"/>

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.password"/>
            </div>

            <div class="form__item">
                <label>
                    <Checkbox name="remember" v-model:checked="form.remember"/>
                    <span>Запомнить меня</span>
                </label>
            </div>

            <div class="form__footer">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="link link--hover-uline"
                >
                    <div class="link__text">
                        Забыли пароль?
                    </div>
                </Link>

                <button class="btn" :disabled="form.processing">
                    Войти
                </button>
            </div>
        </form>
    </GuestLayout>
</template>


<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
