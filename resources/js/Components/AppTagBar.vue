<script setup>
import AppTagBarItem from './AppTagBarItem.vue';

defineProps({
  tags: Array,
  activeTag: String,
})
const emit = defineEmits(['select-tag'])

function select(tag) {
  emit('select-tag', tag)
}
</script>

<template>
    <ul class="flex justify-center gap-[calc(var(--app-padding)*2)] pb-[calc(var(--app-padding)*6)]">
        <li v-for="tag in tags" :key="tag.id" class="w-full">
            <AppTagBarItem :name="tag.name" :icon="tag.icon" :active-tag="activeTag" @click="select(tag.name)"
             />
        </li>
    </ul>
</template>
