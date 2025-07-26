<script setup>
import AppButton from '@/Components/AppButton.vue'
import AddIcon from '@icons/icon-new.svg'
import AdminSearch from '@/Components/Admin/AdminSearch.vue';

defineProps({
    items: Array,
    title: {
        type: String,
        default: 'Fragen'
    },
    buttonText: {
        type: String,
        default: 'Neue Frage erstellen'
    },
    routeName: {
        type: String,
        required: true
    }
})
</script>

<template>
    <div class="flex items-center justify-between mt-16 mb-9">
        <div>
            <div v-if="items">
                <div class="text-2xl text-(--clr-darkgreen-500)">{{ title }} Verwaltung</div>
                <div class="text-sm text-(--clr-gray-500)">{{ items.length }} {{ title }} insgesamt</div>
            </div>
        </div>
        <AdminSearch :placeholder="`Suche nach ${title}`" :routeName="routeName" />
        <div>
            <AppButton @click="$emit('create')" :icon="AddIcon" :title="`${buttonText}`"
                class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)" />
        </div>
    </div>
</template>
