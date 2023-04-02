<template>
    <div v-show="message">
        <p>
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>
