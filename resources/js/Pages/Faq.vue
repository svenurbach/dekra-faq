<script setup>
import { usePage, Head } from '@inertiajs/vue3'
import AppTagBar from '@/Components/AppTagBar.vue';
import AppHeader from '@/Components/AppHeader.vue'
import ContactPanel from '@/Components/ContactPanel.vue';
import AppFaqList from '@/Components/AppFaqList.vue';
import { router } from '@inertiajs/vue3'

const { faqs, tags, activeTag } = usePage().props

function filterByTag(tagName) {
  router.get('/', { tag: tagName }, {
    preserveScroll: true
  })
}
</script>

<template>
        <Head title="Dekra | FAQ" />
        <AppHeader />
        <div class="main-w">
            <AppTagBar :tags="tags" :activeTag="activeTag" @select-tag="filterByTag" class="-mt-9"/>
            <h2 class="text-(--clr-darkgreen-500)">Fragen aus dem Bereich <span class="font-bold">{{ activeTag }}</span></h2>
            <AppFaqList :faqs="faqs" />
            <ContactPanel />
        </div>
</template>
