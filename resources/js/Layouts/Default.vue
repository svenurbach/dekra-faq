<script setup>
import AppFooter from '@/Components/AppFooter.vue';
import AppNavbar from '../Components/AppNavbar.vue';
</script>

<template>
  <AppNavbar />
  <div>
    <main>
      <slot />
    </main>
    <AppFooter />
  </div>
</template>
