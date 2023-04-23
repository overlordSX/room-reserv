<template class="index-template">
    <Base title="hello, world">
        <template v-slot:full-page>
            <SearchRooms />
        </template>
    </Base>

    <!-- пример использования роутов laravel
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    -->
</template>

<script setup lang="ts">
    import Base from "../Layouts/Base.vue";
    import SearchRooms from "../Partials/SearchRooms.vue";
</script>
