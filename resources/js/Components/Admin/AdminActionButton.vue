<script setup>
defineProps({
    icon: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <component
        :is="icon"
        as="button"
        class="size-5 fill-current cursor-pointer text-(--clr-darkgreen-500) hover:text-(--clr-darkgreen-300) transition-colors duration-200"
        v-if="icon"
    />
</template>
