<script setup>
import AppSearch from './AppSearch.vue';
import Triangle from '@assets/design-elements/triangle-bright-green.svg';
</script>

<template>
  <main>
    <header
      class="relative">
      <div class="absolute inset-0 overflow-hidden">
        <Triangle class="absolute w-34 -left-5 top-1/7 rotate-0 opacity-40 fill-(--clr-brightgreen-300)" />
        <Triangle class="absolute w-20 left-14 top-3/7 rotate-180 opacity-50 fill-(--clr-darkgreen-400)" />
        <Triangle class="absolute w-40 left-50 -bottom-15 rotate-0 opacity-40 fill-(--clr-brightgreen-400)" />
        <Triangle class="absolute w-50 right-20 -top-1 rotate-180 opacity-40 fill-(--clr-darkgreen-300)" />
        <Triangle class="absolute w-30 right-28 top-48 rotate-0 opacity-40 fill-(--clr-brightgreen-300)" />
        <Triangle class="absolute w-40 right-70 bottom-0 rotate-180 opacity-50 fill-(--clr-darkgreen-400)" />
      </div>
      <div class="flex flex-col items-center p-[calc(var(--app-padding)*4)] py-[calc(var(--app-padding)*6)]
      pt-[calc(var(--app-padding)*11)] bg-(--clr-darkgreen-800) text-(--clr-white) z-10">
        <h1>Häufig gestellte Fragen</h1>
        <p class="w-[80ch] text-center">Willkommen in unserem Hilfebereich! Hier finden Sie eine Sammlung der häufigsten Fragen und Antworten zu unseren Angeboten und Services. Finden Sie schnell und unkompliziert die Informationen, die Sie suchen.</p>
        <div class="pt-[calc(var(--app-padding)*2)]">
          <AppSearch />
        </div>
      </div>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>
