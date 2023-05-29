 <template>
    <div class="hotel-list-item">
        <div class="hotel-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="hotel-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="hotel-list-item__placeholder">
                <svg width="195" height="70" viewBox="0 0 195 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M82.5 69L148 15L194 52.5"/>
                    <path d="M1 49.5L53.5 1.5L105.5 49.5"/>
                </svg>
            </div>

        </div>

        <div class="hotel-list-item__info">
            <div class="hotel-list-item__name-stars">
                <div class="hotel-list-item__name">
                    {{ item.name }}
                </div>

                <div class="hotel-list-item__stars">
                </div>
            </div>

            <div class="hotel-list-item__count-rooms todo">
                10 номеров
            </div>

            <div class="hotel-list-item__address">
            </div>
        </div>

<!--        <div class="hotel-list-item__actions">
            <Link
                :href="route('dashboard.hotels-list.' + item.id + '.rooms-list.add')"
                class="hotel-list-item__btn btn"
            >Добавить номер
            </Link>

            &lt;!&ndash; //todo можно добавить условие отображения, если номера есть то показывать &ndash;&gt;
            <Link
                :href="route('dashboard.hotels-list.' + item.id + '.rooms-list')"
                class="hotel-list-item__btn btn"
            >Показать номера
            </Link>
        </div>-->
    </div>
</template>

<script setup lang="ts">

import {Link} from "@inertiajs/vue3";
import {TRoom} from "@/types/TRoom";

const props = defineProps<{
    item: TRoom,
}>();
</script>
