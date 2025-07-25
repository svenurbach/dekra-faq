<script setup>
import { usePage, Head } from '@inertiajs/vue3'
import AppCategoryBar from '@/Components/AppCategoryBar.vue';
import AppHeader from '@/Components/AppHeader.vue'
import ContactPanel from '@/Components/ContactPanel.vue';
import AppFaqList from '@/Components/AppFaqList.vue';
import { router } from '@inertiajs/vue3'

const { faqs, categories, activeCategory } = usePage().props

const page = usePage()

function filterByCategory(categoryName) {
  router.get('/', { category: categoryName }, {
    preserveScroll: true
  })
}
</script>

<template>
        <Head title="Dekra | FAQ" />
        <AppHeader />
        <div class="main-w">
            <AppCategoryBar :categories="categories" :activeCategory="activeCategory" @select-category="filterByCategory" class="-mt-9"/>
            <div class="text-(--clr-darkgreen-500)">
              <h2 v-if="activeCategory">
                Fragen aus dem Bereich <span class="font-bold">{{ activeCategory }}</span>
              </h2>
              <h2 v-if="page.url.startsWith('/?search')">Fragen zum Suchbegriff: <span class="font-bold">
                {{ page.props.search }}</span></h2>
            </div>
            <div>
              <AppFaqList v-if="faqs && faqs.length" :faqs="faqs" />
              <div v-else class="text-center text-(--clr-gray-500)">
                <span v-if="activeCategory">Keine Fragen in dieser Kategorie gefunden.</span>
                <span v-else>Keine Fragen gefunden.</span>
              </div>
            </div>
            <ContactPanel />
        </div>
</template>
