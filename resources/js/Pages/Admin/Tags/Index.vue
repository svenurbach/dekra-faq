<script setup>
import { usePage, router, Head } from '@inertiajs/vue3'
import AdminHeader from '@/Components/Admin/AdminHeader.vue';
import AppButton from '@/Components/AppButton.vue'
import AdminActionButton from '@/Components/Admin/AdminActionButton.vue';
import AdminModal from '@/Components/Admin/AdminModal.vue';
import EditIcon from '@icons/icon-edit.svg'
import SaveIcon from '@icons/icon-check.svg'
import DeleteIcon from '@icons/icon-delete-1.svg'
import CloseIcon from '@icons/icon-close-1.svg'
import TrashIcon from '@icons/icon-delete.svg'
import AdminToolBar from '@/Components/Admin/AdminToolBar.vue';
import { route } from 'ziggy-js';
import { ref } from 'vue'

const { tags } = usePage().props

const showCreateModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)

const selectedTag = ref(null)
const form = ref({
  name: '',
  errors: {}
});

function handleErrors(errors) {
  form.value.errors = errors;
}

// Begin Delete
function openConfirmDeleteModal(tag) {
  selectedTag.value = tag
  showDeleteModal.value = true
}

function deleteTag() {
  router.delete(route('tags.destroy', selectedTag.value.id), {
    onSuccess: () => {
      router.get(route('tags.index'))
    },
    onFinish: () => {
      showDeleteModal.value = false
      selectedTag.value = null
    }
  })
}
// End Delete

// Begin Edit
function openEditModal(tag) {
  selectedTag.value = tag
  form.value = { name: tag.name }
  showEditModal.value = true
}

function updateTag() {
  router.put(route('tags.update', selectedTag.value.id), {
    name: form.value.name
  }, {
    onSuccess: () => {
      form.value.errors = {};
      router.get(route('tags.index'));
      showEditModal.value = false;
    },
    onError: (errors) => {
      handleErrors(errors);
    }
  });
}
// End Edit

// Begin Create
function openCreateModal() {
  form.value = { name: '' }
  showCreateModal.value = true
}

function createTag() {
  router.post(route('tags.store'), form.value, {
    onSuccess: () => {
      router.get(route('tags.index'), { preserveScroll: true })
      showCreateModal.value = false
    },
    onError: (errors) => {
      handleErrors(errors);
    }
  })
}
// End Create

</script>

<template>

  <Head title="Dekra | Admin | Tags" />
  <AdminHeader>
    <template #headline>
      Tag Verwaltung
    </template>
    <template #subline>
      Hier verwalten Sie die Schlagwörter (Tags) für Ihre Inhalte. Erstellen, bearbeiten und organisieren Sie Tags, um
      die Auffindbarkeit und Kategorisierung Ihrer digitalen Trainings zu optimieren.
    </template>
  </AdminHeader>
  <div class="main-w">
    <AdminToolBar title="Tags" buttonText="Neuen Tag erstellen" :items="tags" :routeName="'tags.index'" @create="openCreateModal" />
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
            <td class="p-4 border-b border-r border-(--clr-white)">{{ new
              Date(tag.created_at).toLocaleDateString('de-DE',
                {
                  day:
                    '2-digit', month: '2-digit', year: 'numeric'
                }) }}</td>
            <td class="p-4 border-b border-r border-(--clr-white) text-center ">
              <div class="flex justify-center gap-5">
                <AdminActionButton @click.prevent="openEditModal(tag)" :icon="EditIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(tag)" :icon="DeleteIcon" />
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Begin Delete Modal -->
    <AdminModal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #header>
        <h2>Sind Sie sicher, dass Sie den folgenden Tag löschen wollen?</h2>
      </template>
      <div v-if="selectedTag" class="text-(--clr-gray-500) pt-4 pb-9">
        <p>Tag</p>
        <p class="font-bold text-xl">{{ selectedTag.name }}</p>
      </div>
      <template #footer>
        <AppButton title="Abbrechen" :icon=CloseIcon class="bg-(--clr-gray-500) text-(--clr-white)"
          @click="showDeleteModal = false" />
        <AppButton title="Löschen" :icon=TrashIcon class="bg-(--clr-red-700) text-(--clr-white)" @click="deleteTag" />
      </template>
    </AdminModal>
    <!-- End Delete Modal -->

    <!-- Begin Edit Modal -->
    <AdminModal :show="showEditModal" @close="showEditModal = false">
      <template #header>
        <h2>Tag bearbeiten</h2>
      </template>
      <p class="text-sm text-(--clr-gray-500) w-[40ch]">Vergeben Sie einen aussagekräftigen neuen Namen für den Tag</p>
      <form @submit.prevent="updateTag">
        <div class="pt-7 pb-14">
          <input type="text" v-model="form.name" class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)" required />
          <p v-if="form.errors && form.errors.name" class="mt-1 text-sm text-(--clr-red-500)">
            {{ form.errors.name }}
          </p>
        </div>
        <div class="flex justify-between">
          <AppButton title="Abbrechen" :icon=CloseIcon class="bg-(--clr-red-700) text-(--clr-white)"
            @click="showEditModal = false" type="button" />
          <AppButton title="Speichern" :icon=SaveIcon class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)"
            type="submit" />
        </div>
      </form>
    </AdminModal>
    <!-- End Edit Modal -->

    <!-- Begin Create Modal -->
    <AdminModal :show="showCreateModal" @close="showCreateModal = false">
      <template #header>
        <h2>Tag erstellen</h2>
      </template>
      <p class="text-sm text-(--clr-gray-500) w-[40ch]">Vergeben Sie einen aussagekräftigen Namen für den neuen Tag</p>
      <form @submit.prevent="createTag">
        <div class="pt-7 pb-14">
          <input type="text" v-model="form.name" class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)" required />
          <p v-if="form.errors && form.errors.name" class="mt-1 text-sm text-(--clr-red-500)">
            {{ form.errors.name }}
          </p>
        </div>
        <div class="flex justify-between">
          <AppButton title="Abbrechen" :icon=CloseIcon class="bg-(--clr-red-700) text-(--clr-white)"
            @click="showCreateModal = false" type="button" />
          <AppButton title="Speichern" :icon=SaveIcon class="bg-(--clr-darkgreen-500) text-(--clr-brightgreen-200)"
            type="submit" />
        </div>
      </form>
    </AdminModal>
    <!-- End Create Modal -->

  </div>
</template>
