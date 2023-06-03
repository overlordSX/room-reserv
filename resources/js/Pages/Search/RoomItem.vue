 <template>
    <Link
        :href="route('search.available-room', {
            room: item.id,
            ...searchParams,
        })"
        class="room-list-item">
        <div class="room-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="room-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="room-list-item__placeholder">
                <PicturePlaceholderSvg />
            </div>

        </div>

        <div class="room-list-item__content">
            <div class="room-list-item__name">
                {{ item.name }}
            </div>

            <div class="room-list-item__info-price">
                <div class="room-list-item__info">
                    <div class="room-list-item__count-of-beds">
                        {{ item.countOfBeds }} {{plural(['комната','комнаты','комнат'], item.countOfBeds)}}
                    </div>

                    <div class="room-list-item__count-of-beds">
                        {{ item.countOfBeds }} {{plural(['кровать','кровати','кроватей'], item.countOfBeds)}}
                    </div>

                    <div class="room-list-item__square">
                        {{ item.square }} м.кв.
                    </div>
                </div>

                <div class="room-list-item__price-btn">
                    <div class="room-list-item__price-night">
                        <Price :value="item.price * countOfDays"/>
                        / {{countOfDays + ' ' + plural(['ночь','ночи','ночей'], countOfDays)}}
                    </div>

                    <div class="room-list-item__btn">
                        <button class="btn">Выбрать</button>
                    </div>
                </div>
            </div>
        </div>
    </Link>
</template>

<script setup lang="ts">

import {Link} from "@inertiajs/vue3";
import {TRoom} from "@/types/TRoom";
import Price from "@/Components/Price.vue";
import {plural} from "@/helpers/common";
import PicturePlaceholderSvg from "@/Components/PicturePlaceholderSvg.vue";
import {TSearchParams} from "@/types/TSearchParams";
import {computed} from "vue";

const props = defineProps<{
    item: TRoom,
    searchParams: TSearchParams,
}>();

const countOfDays = computed<number>(() => {
    let start = new Date(props.searchParams.startDate);
    let end = new Date(props.searchParams.endDate);

    return Math.abs(Math.floor((end - start) / (1000 * 60 * 60 * 24)));
});
</script>
