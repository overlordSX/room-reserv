<template class="index-template">
    <Base title="Главная страница" :can-login="canLogin" :can-register="canRegister">
        <template v-slot:full-page>
            <SearchRooms :hotelsMin="hotelsMin" />
        </template>
    </Base>
</template>

<script setup lang="ts">
    import Base from "../Layouts/Base.vue";
    import SearchRooms from "../Partials/SearchRooms.vue";
    import {TFormValueOption} from "@/types/TFormValueOption";

    type TComponentProps = {
        title?: string,
        canLogin?: boolean;
        canRegister?: boolean;
        hotelsMin: Array<TFormValueOption>,
    };

    const props = defineProps<TComponentProps>();
</script>
