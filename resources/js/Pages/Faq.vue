<script setup>
import { ref } from 'vue'
import { usePage, Head } from '@inertiajs/vue3'

const faqs = ref(usePage().props.faqs)
</script>

<template>
  <Head title="FAQ" />
  <div>
    <h1>Häufig gestellte Fragen</h1>
    <ul>
      <li v-for="faq in faqs" :key="faq.id">
        <h2>{{ faq.question }}</h2>
        <p>{{ faq.answer }}</p>
      </li>
    </ul>
  </div>
</template>
