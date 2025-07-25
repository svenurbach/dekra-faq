<script setup>
import CompanyLogo from '@assets/logo/dekra-logo-white.svg';
import { Link } from '@inertiajs/vue3';

</script>

<template>
  <div>
    <Link href="/"><component :is="CompanyLogo" class="w-46 fill-white"/></Link>
  </div>
</template>
