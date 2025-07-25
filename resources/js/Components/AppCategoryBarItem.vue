<script setup>
const props = defineProps({
    name: String,
    icon: String,
    activeCategory: String
});
</script>

<template>
    <button
        class="relative px-[calc(var(--app-padding)*2)] py-[calc(var(--app-padding))] flex items-center text-(--clr-darkgreen-700) bg-(--clr-white) w-full h-[112px] cursor-pointer rounded-(--app-radius) shadow-lg overflow-hidden border-1"
        @click="$emit('click')"
        :class="name === activeCategory ? 'bg-[var(--clr-darkgreen-500)] text-[var(--clr-brightgreen-300)] border-(--clr-darkgreen-400) font-bold' : 'border-(--clr-gray-100)'">
        <div v-if="icon" class="absolute right-[-12px] top-[-12px] rounded-full bg-(--clr-darkgreen-100) w-20 h-20 flex items-center justify-center">
            <component :is="icon" class="size-10 fill-(--clr-darkgreen-500)" alt="Category Icon"/>
        </div>
        <span class="text2xl">{{ name }}</span>
    </button>
</template>
