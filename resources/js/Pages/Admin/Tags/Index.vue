<script setup>
import { usePage, router } from '@inertiajs/vue3'
import AdminHeader from '@/Components/Admin/AdminHeader.vue';
import AppButton from '@/Components/AppButton.vue'
import AdminActionButton from '@/Components/Admin/AdminActionButton.vue';
import AdminModal from '@/Components/Admin/AdminModal.vue';
import EditIcon from '@icons/icon-edit.svg'
import DeleteIcon from '@icons/icon-delete-1.svg'
import AdminToolBar from '@/Components/Admin/AdminToolBar.vue';
import { route } from 'ziggy-js';
import { ref } from 'vue'

const { tags } = usePage().props

const showCreateModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)
const selectedTag = ref(null)

// Löschen
function openConfirmDeleteModal(tag) {
  selectedTag.value = tag
  showDeleteModal.value = true
}

function deleteTag() {
  router.delete(route('tags.destroy', selectedTag.value.id), {
    onSuccess: () => {
      router.get(route('tags.index'), { preserveScroll: true })
    },
    onFinish: () => {
      showDeleteModal.value = false
      selectedTag.value = null
    }
  })
}

</script>

<template>

  <Head title="Dekra | Admin | Tags" />
  <AdminHeader>
    <template #headline>
      Tag Verwaltung
    </template>
    <template #subline>
        Hier verwalten Sie die Schlagwörter (Tags) für Ihre Inhalte. Erstellen, bearbeiten und organisieren Sie Tags, um die Auffindbarkeit und Kategorisierung Ihrer digitalen Trainings zu optimieren.
    </template>
  </AdminHeader>
  <div class="main-w">
    <AdminToolBar title="Tags" buttonText="Neuen Tag erstellen" :items="tags" />
    <div
      class="overflow-x-auto border border-(--clr-gray-200) bg-(--clr-gray-100) shadow-lg rounded-lg text-(--clr-gray-600)">
      <table class="w-full table-auto md:table-fixed">
        <thead class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200) text-left">
          <tr class="rounded-lg">
            <th class="p-4 border-b border-r border-(--clr-white)">Name</th>
            <th class="p-4 border-b border-r border-(--clr-white) w-[20ch]">Erstellt am</th>
            <th class="p-4 border-b border-(--clr-white) w-[12ch]">Aktionen</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tag in tags" :key="tag.id">
            <td class="p-4 border-b border-r border-(--clr-white)">{{ tag.name }}</td>
            <td class="p-4 border-b border-r border-(--clr-white)">{{ new Date(tag.created_at).toLocaleDateString('de-DE', {
              day:
                '2-digit', month: '2-digit', year: 'numeric'
            }) }}</td>
            <td class="p-4 border-b border-r border-(--clr-white) text-center ">
              <div class="flex justify-center gap-5">
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="EditIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="DeleteIcon" />
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <AdminModal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #header>
        <h2>Sind Sie sicher, dass Sie den folgenden Tag löschen wollen?</h2>
      </template>
      <div v-if="selectedTag">
        <p>Tag</p>
        <p class="font-bold">{{ selectedTag.name }}</p>
      </div>
      <template #footer>
        <AppButton title="Abbrechen" icon="/resources/assets/icons/icon-close.svg" class="bg-gray-300 text-gray-700"
          @click="showDeleteModal = false" />
        <AppButton title="Löschen" class="bg-red-600 text-white" @click="deleteTag" />
      </template>
    </AdminModal>
  </div>
</template>
