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
  <div class="flex w-full md:w-lg h-20 pt-[calc(var(--app-padding)*2)]">
    <input
      v-model="query"
      @keyup.enter="search"
      type="text"
      placeholder="Suche nach etwas..."
      class="rounded-l-lg bg-(--clr-white) w-full placeholder-(--clr-black) text-(--clr-black) p-(--app-padding) overflow-hidden"
    />
    <button @click="search" class="bg-(--clr-brightgreen-200) rounded-r-md text-(--clr-darkgreen-500) px-4 h-full flex items-center w-content cursor-pointer transition-all duration-200 hover:scale-105">
      <component :is="SearchIcon" alt="Search Icon" class="size-5 mr-4 fill-(--clr-darkgreen-500)"/>
       <span class="font-bold">Suchen</span>
    </button>
  </div>
</template>
