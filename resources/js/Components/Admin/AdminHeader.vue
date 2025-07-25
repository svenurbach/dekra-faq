<script setup>
import Triangle from '@assets/design-elements/triangle-bright-green.svg';
</script>

<template>
  <main>
    <header
      class="relative flex flex-col items-center py-[calc(var(--app-padding)*4)] pt-[calc(var(--app-padding)*11)] bg-(--clr-darkgreen-800) text-(--clr-white)">
      <div class="absolute inset-0 overflow-hidden">
        <Triangle class="absolute w-34 -left-5 top-1/7 rotate-0 fill-(--clr-brightgreen-300)" />
        <Triangle class="absolute w-20 left-14 top-3/7 rotate-180 fill-(--clr-darkgreen-400)" />
        <Triangle class="absolute w-40 left-50 -bottom-15 rotate-0 fill-(--clr-brightgreen-400)" />
        <Triangle class="absolute w-50 right-20 -top-1 rotate-180 fill-(--clr-darkgreen-300)" />
        <Triangle class="absolute w-30 right-28 top-48 rotate-0 fill-(--clr-brightgreen-300)" />
        <Triangle class="absolute w-40 right-70 bottom-0 rotate-180 fill-(--clr-darkgreen-400)" />
      </div>
      <h1>
        <slot name="headline" />
      </h1>
      <p class="w-[80ch] text-center">
        <slot name="subline" />
      </p>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>
