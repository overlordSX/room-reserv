<template>
    <form class="add-hotel-form" @submit.prevent="submit">
        <div class="add-hotel-form__item">
            <label for="photo" class="btn">
                Добавить картинку
            </label>
            <input
                id="photo"
                type="file"
                class="input-file"
                @input="form.photo = $event.target.files[0]"
                @change="previewImage"
            />

            <InputError v-if="form.errors.photo" :message="form.errors.photo"/>
        </div>

        <div v-if="url" class="add-hotel-form__image-preview">
            <img :src="url" alt="">
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="name" value="Название"/>

            <TextInput
                id="name"
                type="text"
                v-model="form.name"
                placeholder="Элеон"
                required
                autofocus
                :is-green="true"
            />

            <InputError v-if="form.errors.name" :message="form.errors.name"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="countOfStars" value="Количество звезд"/>

            <InputNumber
                id="countOfStars"
                v-model="form.countOfStars"
                required
                min="1"
                max="5"
            />

            <InputError v-if="form.errors.countOfStars" :message="form.errors.countOfStars"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="address" value="Адрес"/>

            <TextInput
                id="address"
                type="text"
                v-model="form.address"
                required
                placeholder="г. Иваново, ул Иванова, 1"
                :is-green="true"
            />

            <InputError v-if="form.errors.address" :message="form.errors.address"/>
        </div>

        <div class="form__footer">
            <button class="btn"
                    :disabled="form.processing">
                Отправить
            </button>
        </div>
    </form>
</template>

<script setup lang="ts">


import { useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputNumber from "@/Components/InputNumber.vue";
import FileInput from "@/Components/FileInput.vue";
import {ref} from "vue";

const form = useForm({
    name: '',
    countOfStars: 5,
    address: '',
    photo: null,
});

const submit = () => {
    form.post(route('dashboard.hotels-list.save'), {
         forceFormData: true,
     });
};

const url = ref<URL | null>(null);

function previewImage(e) {
    const file = e.target.files[0];
    url.value = new URL(URL.createObjectURL(file));
}
</script>
