<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import SearchIcon from '@icons/icon-search.svg'

const query = ref('')

function search() {
  if (!query.value) return

  router.get('/', { search: query.value }, {
    preserveScroll: true,
  })
}

</script>

<template>
  <div class="relative w-lg">
    <input
      v-model="query"
      @keyup.enter="search"
      type="text"
      placeholder="Suche nach etwas..."
      class="rounded-lg bg-(--clr-white) h-12 w-full placeholder-(--clr-black) text-(--clr-black) p-(--app-padding) overflow-hidden"
    />
    <button @click="search" class="absolute right-0 top-1/2 -translate-y-1/2 bg-(--clr-brightgreen-200) rounded-r-md text-(--clr-darkgreen-500) py-3 px-4 h-full flex items-center w-content cursor-pointer transition-all duration-200 hover:scale-105">
      <component :is="SearchIcon" alt="Search Icon" class="size-5 mr-4 fill-(--clr-darkgreen-500)"/>
       <span class="font-bold">Suchen</span>
    </button>
  </div>
</template>
