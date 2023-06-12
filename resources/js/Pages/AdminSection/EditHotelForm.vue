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

        <div v-else-if="form.photo" class="add-hotel-form__image-preview">
            <img :src="form.photo" alt="">
        </div>

        <div v-if="url || form.photo" class="add-hotel-form__item">
        <button class="btn btn--red" @click="deletePicture()">Удалить картинку</button>
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
                autocomplete="off"
                :is-green="true"
            />

            <InputError v-if="form.errors.name" :message="form.errors.name"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="countOfStars" value="Количество звезд"/>

            <InputNumber
                id="countOfStars"
                v-model="form.countOfStars"
                autocomplete="off"
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
                autocomplete="off"
                required
                placeholder="г. Иваново, ул Иванова, 1"
                :is-green="true"
            />

            <InputError v-if="form.errors.address" :message="form.errors.address"/>
        </div>

        <div class="form__footer">
            <button class="btn"
                    :disabled="form.processing">
                Сохранить изменения
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
import {ref} from "vue";
import {THotel} from "@/types/THotel";

const props = defineProps<{
    hotel: THotel,
}>();

const form = useForm({
    name: props.hotel.name,
    countOfStars: props.hotel.countOfStars,
    address: props.hotel.address,
    photo: props.hotel.photoUrl,
});

const submit = () => {
    form.post(route('dashboard.hotel.update', {hotel: props.hotel.id}), {
        forceFormData: true,
    });
};

const url = ref<URL | null>(null);

function previewImage(e) {
    const file = e.target.files[0];
    url.value = new URL(URL.createObjectURL(file));
}

function deletePicture() {
    form.photo = null;
}
</script>
