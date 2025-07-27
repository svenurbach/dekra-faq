<script setup>
import AppCategoryBarItem from './AppCategoryBarItem.vue';
import CategoryItemAllgemeines from '@icons/icon-categorie-allgemeines.svg';
import CategoryItemServices from '@icons/icon-categorie-services.svg';
import CategoryItemMedien from '@icons/icon-categorie-medien.svg';
import CategoryItemZahlungen from '@icons/icon-categorie-payment.svg';

const emit = defineEmits(['select-category'])

defineProps({
  categories: {
    type: Array,
    required: true
  },
  activeCategory: {
    type: String,
    default: null
  }
})

function select(category) {
  emit('select-category', category)
}

const iconMap = {
  Allgemeines: CategoryItemAllgemeines,
  Services: CategoryItemServices,
  Medien: CategoryItemMedien,
  Zahlungen: CategoryItemZahlungen,
};

</script>

<template>
    <ul class="grid grid-cols-2 md:grid-cols-4 gap-[calc(var(--app-padding)*2)]  pb-[calc(var(--app-padding)*6)]">
        <li v-for="category in categories" :key="category.id" class="basis-1/2 md:w-full">
            <AppCategoryBarItem :name="category.name" :icon="iconMap[category.name]" :active-category="activeCategory" @click="select(category.name)"
             />
        </li>
    </ul>
</template>
