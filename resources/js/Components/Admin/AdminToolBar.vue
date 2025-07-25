<script setup>
import AppButton from '@/Components/AppButton.vue'
import AddIcon from '@icons/icon-new.svg'

defineProps({
    items: {
        type: Array
    },
    title: {
        type: String,
        default: 'Fragen'
    },
    buttonText: {
        type: String,
        default: 'Neue Frage erstellen'
    }
})
</script>

<template>
    <div class="flex items-center justify-between mt-10 mb-6">
        <div>
            <div v-if="items">
                <div class="text-2xl text-(--clr-darkgreen-500)">{{ title }} Verwaltung</div>
                <div class="text-sm text-(--clr-gray-500)">{{ items.length }} {{ title }} insgesamt</div>
            </div>
        </div>
        <div>Suche nach {{ title }}</div>
        <div>
            <AppButton @click="$emit('create')" :icon="AddIcon" :title="`${buttonText}`"
                class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)" />
        </div>
    </div>
</template>
