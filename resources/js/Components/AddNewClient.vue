<template>
    <VueFinalModal class="">
        <div class="add-new-load-popup">
            <div class="page__section-title">Форма добавления клиента</div>

            <form class="add-hotel-form" @submit.prevent="submit">
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

                <div class="form__footer">
                    <button class="btn"
                            :disabled="form.processing">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </VueFinalModal>
</template>

<script setup lang="ts">
import {VueFinalModal, useModal} from "vue-final-modal";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps<{
}>();

const form = useForm({
    name: '',
    family: '',
    surname: '',
    phone: '',
    email: '',
});

const emit = defineEmits<{
    (e: 'confirm'): void
}>()


const submit = () => {
    form.post(route('dashboard.clients.save'), {
        onSuccess: () => emit('confirm'),
    })
};

</script>
