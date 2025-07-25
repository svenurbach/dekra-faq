<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  password: '',
})

function submit() {
  form.post('/login')
}
</script>

<template>
  <div class="max-w-md mx-auto mt-10">
    <h1 class="text-xl font-bold mb-4">Login</h1>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block mb-1">Benutzername</label>
        <input v-model="form.name" type="text" class="w-full border p-2" />
        <div v-if="form.errors.name" class="text-red-600 text-sm">{{ form.errors.name }}</div>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Passwort</label>
        <input v-model="form.password" type="password" class="w-full border p-2" />
        <div v-if="form.errors.password" class="text-red-600 text-sm">{{ form.errors.password }}</div>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2">Login</button>
    </form>
  </div>
</template>
