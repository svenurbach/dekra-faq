<script setup>
import { usePage } from '@inertiajs/vue3'
import AdminActionButton from '@/Components/Admin/AdminActionButton.vue';
import AdminHeader from '@/Components/Admin/AdminHeader.vue';
import AppButton from '@/Components/AppButton.vue'
import EditIcon from '@assets/icons/icon-edit.svg'
import DeleteIcon from '@assets/icons/icon-delete-1.svg'
import MoveUpIcon from '@assets/icons/icon-sort-up.svg'
import MoveDownIcon from '@assets/icons/icon-sort-down.svg'
import { route } from 'ziggy-js';
import { ref } from 'vue'

const { faqs } = usePage().props

console.log('FAQs:', faqs)
</script>

<template>
  <Head title="Dekra | Admin | Fragen" />
    <AdminHeader>
    <template #headline>
      FAQ Verwaltung
    </template>
    <template #subline>
      Willkommen im Bereich für die Verwaltung Ihrer Fragen. Hier können Sie neue Fragen für Quizzes, Tests oder FAQs erstellen, bestehende Fragen anpassen und Ihre Fragensammlungen effizient organisieren.
    </template>
  </AdminHeader>
  <div class="main-w">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h2>Fragen Verwaltung</h2>
        {{ faqs.length }} Fragen insgesamt
      </div>
      <div>AdminSearchBar</div>
      <div>
        <AppButton title="Neue Frage erstellen" class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)"/>
      </div>
    </div>
    <div class="overflow-x-auto border border-(--clr-gray-200) bg-(--clr-gray-100) shadow-lg rounded-lg text-(--clr-gray-600)">
      <table class="w-full">
        <thead class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200) text-left">
          <tr class="rounded-lg">
            <th class="p-4 border-b border-r border-(--clr-white)">Frage</th>
            <th class="p-4 border-b border-(--clr-white)">Kategorie</th>
            <th class="p-4 border-b border-r border-(--clr-white)">Erstellt am</th>
            <th class="p-4 border-b border-(--clr-white)">Aktionen</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="faq in faqs" :key="faq.id">
            <td class="p-4 border-b border-r border-(--clr-white)">{{ faq.question }}</td>
            <td class="p-4 border-b border-(--clr-white)">{{ faq.category.name }}</td>
            <td class="p-4 border-b border-r border-(--clr-white)">{{ new Date(faq.created_at).toLocaleDateString('de-DE', { day: '2-digit', month: '2-digit', year: 'numeric' }) }}</td>
            <td class="p-4 border-b border-(--clr-white) text-center">
              <div class="flex justify-center gap-3">
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="EditIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="DeleteIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="MoveUpIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="MoveDownIcon" />
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
