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

<!--                                <div class="show-room__price-night">
                                    <Price :value="item.price"/>
                                    / ночь
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="show-room-page__form">
                        форма тут будет
                    </div>

                    <div class="show-room-page__features todo">
                        Нужно ли прикручивать категории, со списоком удобств?
                    </div>
                </div>
            </div>
        </template>
    </Base>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import Base from "@/Layouts/Base.vue";
import {TRoom} from "@/types/TRoom";
import {TSearchParams} from "@/types/TSearchParams";
import PicturePlaceholderSvg from "@/Components/PicturePlaceholderSvg.vue";
import Price from "@/Components/Price.vue";
import {plural} from "@/helpers/common";

const props = defineProps<{
    item: TRoom,
    searchParams: TSearchParams,
}>();

</script>
