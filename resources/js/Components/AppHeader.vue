<script setup>
import AppNavbar from './AppNavbar.vue';
import AppSearch from './AppSearch.vue';
</script>

<template>
  <main>
    <AppNavbar />
    <header class="flex flex-col items-center p-[calc(var(--app-padding)*4)] py-[calc(var(--app-padding)*6)] pt-[calc(var(--app-padding)*11)] bg-(--clr-darkgreen-800) text-(--clr-white)">
      <h1>Häufig gestellte Fragen</h1>
      <p class="w-[80ch]">Willkommen in unserem Hilfebereich! Hier finden Sie eine Sammlung der häufigsten Fragen und Antworten zu unseren Angeboten und Services. Finden Sie schnell und unkompliziert die Informationen, die Sie suchen.</p>
      <div class="pt-[calc(var(--app-padding)*2)]">
        <AppSearch />
      </div>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>
