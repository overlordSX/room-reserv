 <template>
    <div class="room-list-item">
        <div class="room-list-item__picture-wrapper">
            <div v-if="item.photoUrl" class="room-list-item__picture">
                <picture>
                    <img :src="item.photoUrl" :alt="item.name">
                </picture>
            </div>

            <div v-else class="room-list-item__placeholder">
                <svg width="195" height="70" viewBox="0 0 195 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M82.5 69L148 15L194 52.5"/>
                    <path d="M1 49.5L53.5 1.5L105.5 49.5"/>
                </svg>
            </div>

        </div>

        <div class="room-list-item__content">
            <div class="room-list-item__name-stars">
                <div class="room-list-item__name">
                    {{ item.name }}
                </div>

                <div class="room-list-item__price-night">
                    <Price :value="item.price" /> / ночь
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import {Link} from "@inertiajs/vue3";
import {TRoom} from "@/types/TRoom";
import Price from "@/Components/Price.vue";

const props = defineProps<{
    item: TRoom,
}>();
</script>
