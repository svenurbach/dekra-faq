<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
        required: true
    },
    icon: {
        type: String,
    },
    href: {
        type: String,
        required: false
    }
});
</script>

<template>
        <button class="py-3 px-4 rounded-sm flex items-center justify-center cursor-pointer">
            <img v-if="icon" :src="icon" alt="Button Icon" class="w-5"/>
            <span v-if="title" class="pl-4 font-bold">{{ title }}</span>
        </button>
</template>
