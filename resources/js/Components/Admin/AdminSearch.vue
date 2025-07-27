<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import SearchIcon from '@icons/icon-search.svg'
import { route } from 'ziggy-js'

const props = defineProps({
  placeholder: {
    type: String,
    default: 'Suche...'
  },
  routeName: {
    type: String,
    required: true
  }
})

const query = ref('')

function search() {
  if (!query.value) return

  router.get(route(props.routeName), { search: query.value }, {
    preserveScroll: true,
  })
}
</script>

<template>
  <div class="relative w-xl">
    <input v-model="query" @keyup.enter="search" type="text" :placeholder
      class="rounded-lg h-12 w-full text-(--clr-gray-900) bg-(--clr-gray-100) border border-(--clr-gray-200) p-(--app-padding) overflow-hidden" />
    <button @click="search"
      class="absolute right-0 top-1/2 -translate-y-1/2 bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200) rounded-r-md py-3 px-4 h-full flex items-center w-content cursor-pointer transition-all duration-200 hover:scale-105">
      <component :is="SearchIcon" alt="Search Icon" class="size-5 mr-4 fill-(--clr-brightgreen-200)" />
      <span class="font-bold">Suchen</span>
    </button>
  </div>
</template>
