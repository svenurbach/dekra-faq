<script setup>
import { router } from '@inertiajs/vue3'
import ArrowLeft from '@assets/icons/icon-arrow-left.svg'
import { computed } from 'vue'

defineProps({
  links: {
    type: Array,
    required: true
  }
})

function isNav(link, type) {
  return link.label && link.label.toLowerCase().includes(type)
}
</script>

<template>
  <nav v-if="links && links.length" class="mt-14 flex justify-center gap-2">
    <button
      v-for="link in links"
      :key="link.label"
      :disabled="!link.url"
      @click="link.url && router.get(link.url)"
      class="size-10 rounded-md border border-(--clr-darkgreen-500) text-(--clr-darkgreen-500) cursor-pointer flex items-center justify-center"
      :class="{
        'bg-(--clr-darkgreen-500) text-(--clr-white) fill-(--clr-white)': link.active || isNav(link, 'next') || isNav(link, 'previous')
      }"
    >
      <template v-if="isNav(link, 'previous')">
        <component :is="ArrowLeft" class="size-5" />
      </template>
      <template v-else-if="isNav(link, 'next')">
        <component :is="ArrowLeft" class="size-5 rotate-180" />
      </template>
      <template v-else>
        <span v-html="link.label" />
      </template>
    </button>
  </nav>
</template>
