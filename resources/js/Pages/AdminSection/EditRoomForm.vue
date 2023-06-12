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
                placeholder="Односпальный номер, эконом"
                required
                autofocus
                :is-green="true"
            />

            <InputError v-if="form.errors.name" :message="form.errors.name"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="price" value="Стоимость проживания за 1 сутки"/>

            <InputNumber
                id="square"
                v-model="form.price"
                placeholder="1500"
                required
                min="0"
                step="100"
            />

            <InputError v-if="form.errors.price" :message="form.errors.price"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="square" value="Площадь, кв.м"/>

            <InputNumber
                id="square"
                v-model="form.square"
                placeholder="20"
                required
                min="9"
            />

            <InputError v-if="form.errors.square" :message="form.errors.square"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="countOfRooms" value="Количество комнат"/>

            <InputNumber
                id="countOfRooms"
                v-model="form.countOfRooms"
                required
                placeholder="1"
                min="1"
                max="100"
            />

            <InputError v-if="form.errors.countOfRooms" :message="form.errors.countOfRooms"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="floor" value="Этаж"/>

            <InputNumber
                id="floor"
                v-model="form.floor"
                required
                placeholder="1"
                min="1"
                max="500"
            />

            <InputError v-if="form.errors.floor" :message="form.errors.floor"/>
        </div>

        <div class="add-hotel-form__item">
            <InputLabel for="countOfBeds" value="Количество кроватей"/>

            <InputNumber
                id="countOfBeds"
                v-model="form.countOfBeds"
                required
                placeholder="1"
                min="1"
                max="100"
            />

            <InputError v-if="form.errors.countOfBeds" :message="form.errors.countOfBeds"/>
        </div>

        <div class="form__footer">
            <button class="btn"
                    :disabled="form.processing">
                Сохранить измениня
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
import {TRoom} from "@/types/TRoom";

const props = defineProps<{room: TRoom}>();

const form = useForm({
    name: props.room.name,
    price: props.room.price,
    square: props.room.square,
    countOfRooms: props.room.countOfRooms,
    countOfBeds: props.room.countOfBeds,
    floor: props.room.floor,
    photo: props.room.photoUrl,
});

const submit = () => {
    form.post(route('dashboard.room.update', {room: props.room.id}), {
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
