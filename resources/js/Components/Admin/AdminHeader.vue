<script setup>
</script>

<template>
  <main>
    <header class="flex flex-col items-center py-[calc(var(--app-padding)*4)] pt-[calc(var(--app-padding)*11)] bg-(--clr-darkgreen-800) text-(--clr-white)">
      <h1><slot name="headline" /></h1>
      <p class="w-[80ch] text-center">
        <slot name="subline" />
      </p>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>
