<script setup>
import Triangle from '@assets/design-elements/triangle-bright-green.svg';
</script>

<template>
  <main>
    <header>
      <div class="relative bg-(--clr-darkgreen-800) text-(--clr-white)">
        <div class="absolute inset-0 overflow-hidden">
          <Triangle class="absolute w-34 -left-5 top-1/7 rotate-0 fill-(--clr-brightgreen-400)" />
          <Triangle class="absolute w-20 left-14 top-3/7 rotate-180 fill-(--clr-darkgreen-400)" />
          <Triangle class="absolute w-40 left-50 -bottom-35 rotate-0 fill-(--clr-brightgreen-200)" />
          <Triangle class="absolute w-50 right-20 -top-1 rotate-180 fill-(--clr-darkgreen-300)" />
          <Triangle class="absolute w-30 right-22 top-50 rotate-0 fill-(--clr-brightgreen-200)" />
          <Triangle class="absolute w-40 right-80 -bottom-20 rotate-180 fill-(--clr-darkgreen-400)" />
        </div>
        <div
          class="relative z-10 flex flex-col items-center pb-[calc(var(--app-padding)*6)] pt-[calc(var(--app-padding)*11)]">
          <h1>
            <slot name="headline" />
          </h1>
          <p class="md:w-[80ch] text-center">
            <slot name="subline" />
          </p>
        </div>
      </div>
    </header>
    <article>
      <slot />
    </article>
  </main>
</template>
