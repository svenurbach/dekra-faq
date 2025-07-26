<script setup>
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'
import AdminHeader from '@/Components/Admin/AdminHeader.vue'
import AppButton from '@/Components/AppButton.vue'

const form = useForm({
  name: '',
  password: '',
})

function submit() {
  form.post('/login')
}
</script>

<template>
    <Head title="Dekra | Login" />
  <AdminHeader>
    <template #headline>
      Anmeldung
    </template>
    <template #subline>
        Hier können Sie sich anmelden, um auf die Verwaltungsfunktionen zuzugreifen.
    </template>
  </AdminHeader>
  <div class="max-w-md mx-auto mt-10">
    <form @submit.prevent="submit" class="flex flex-col gap-8">
      <div >
        <div class="mb-4">
          <label class="block mb-1">Benutzername</label>
          <input v-model="form.name" type="text" class="w-full rounded-lg border p-2" />
          <div v-if="form.errors.name" class="text-(--clr-red-500) text-sm">{{ form.errors.name }}</div>
        </div>
        <div>
          <label class="block mb-1">Passwort</label>
          <input v-model="form.password" type="password" class="w-full rounded-lg border p-2" />
          <div v-if="form.errors.password" class="text-(--clr-red-500) text-sm">{{ form.errors.password }}</div>
        </div>
      </div>
      <AppButton type="submit" title="Anmelden" class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)" />
    </form>
  </div>
</template>
