<script setup>
defineProps({
    title: {
        type: String,
        required: true
    },
    icon: {
        type: Object,
    }
});
</script>

<template>
    <button class="py-3 px-4 rounded-sm flex items-center justify-center cursor-pointer">
        <component :is="icon" class="size-5 fill-current mr-4" v-if="icon" />
        <span v-if="title" class="font-bold">{{ title }}</span>
    </button>
</template>
