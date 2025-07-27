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
import RemoveIcon from '@icons/icon-remove.svg'
import TrashIcon from '@icons/icon-delete.svg'
import AdminToolBar from '@/Components/Admin/AdminToolBar.vue';
import { route } from 'ziggy-js';
import { ref, computed } from 'vue'
import MoveUpIcon from '@assets/icons/icon-sort-up.svg'
import MoveDownIcon from '@assets/icons/icon-sort-down.svg'
import AdminPagination from '@/Components/Admin/AdminPagination.vue';

const { faqs, categories, tags } = usePage().props


const showCreateModal = ref(false)
const showEditModal = ref(false)
const showDeleteModal = ref(false)

const selectedFaq = ref(null)
const selectedTag = ref(null)
const form = ref({
  question: '',
  answer: '',
  category_id: '',
  tags: [],
  errors: {}
});

// Begin Tag Handling
const availableTags = computed(() => {
  return tags.filter(tag => !form.value.tags.includes(tag.id));
});

function addTag() {
  if (selectedTag.value && !form.value.tags.some(t => t.id === selectedTag.value.id)) {
    form.value.tags.push({
      id: selectedTag.value.id,
      name: selectedTag.value.name
    });
    selectedTag.value = null;
  }
}

function removeTag(index) {
  if (form.value.tags) {
    form.value.tags.splice(index, 1)
  }
}
// End Tag Handling

function handleErrors(errors) {
  form.value.errors = errors;
}

const moveUp = (id) => {
  router.post(`/admin/faqs/${id}/move-up`, {}, {
    onSuccess: () => {
      router.visit(route('faqs.index'), {
        preserveScroll: true,
        onSuccess: (page) => {
          faqs.value = page.props.faqs;
        }
      });
    }
  })
}

const moveDown = (id) => {
  router.post(`/admin/faqs/${id}/move-down`, {}, {
    onSuccess: () => {
      router.visit(route('faqs.index'), {
        preserveScroll: true,
        onSuccess: (page) => {
          faqs.value = page.props.faqs;
        }
      });
    }
  })
};

// Begin Delete
function openConfirmDeleteModal(faq) {
  selectedFaq.value = faq
  showDeleteModal.value = true
}

function deleteFaq() {
  router.delete(route('faqs.destroy', selectedFaq.value.id), {
    onSuccess: () => {
      router.get(route('faqs.index'))
    },
    onFinish: () => {
      showDeleteModal.value = false
      selectedFaq.value = null
    }
  })
}
// End Delete

// Begin Create
function openCreateModal() {
  form.value = {
    question: '',
    answer: '',
    category_id: '',
    tags: [],
  }
  selectedTag.value = null
  showCreateModal.value = true
}

function createFaq() {
  const payload = {
    question: form.value.question,
    answer: form.value.answer,
    category_id: form.value.category_id,
    tags: form.value.tags.map(tag => tag.id)
  };

  router.post(route('faqs.store'), payload, {
    onSuccess: () => {
      router.get(route('faqs.index'), { preserveScroll: true });
      showCreateModal.value = false;
    },
    onError: (errors) => {
      handleErrors(errors);
      console.error('Fehler:', errors);
    }
  });
}
// End Create

// Begin Edit
function openEditModal(faq) {
  selectedFaq.value = faq;
  form.value = {
    question: faq.question,
    answer: faq.answer,
    category_id: faq.category_id,
    tags: faq.tags.map(tag => ({ id: tag.id, name: tag.name })),
    errors: {}
  };
  showEditModal.value = true;
}

function updateFaq() {
  router.put(route('faqs.update', selectedFaq.value.id), {
    question: form.value.question,
    answer: form.value.answer,
    category_id: form.value.category_id,
    tags: form.value.tags.map(tag => tag.id)
  }, {
    onSuccess: () => {
      router.get(route('faqs.index'));
      showEditModal.value = false;
    },
    onError: (errors) => {
      form.value.errors = errors;
    }
  });
}
// End Edit

</script>

<template>

  <Head title="Dekra | Admin | Fragen" />
  <AdminHeader>
    <template #headline>
      FAQ Verwaltung
    </template>
    <template #subline>
      Willkommen im Bereich für die Verwaltung Ihrer Fragen. Hier können Sie neue Fragen für Quizzes, Tests oder FAQs
      erstellen, bestehende Fragen anpassen und Ihre Fragensammlungen effizient organisieren.
    </template>
  </AdminHeader />
  <div class="main-w">
    <AdminToolBar title="Fragen" buttonText="Neue Frage erstellen" :items="faqs" :routeName="'faqs.index'"
      @create="openCreateModal" />
    <div
      class="overflow-x-auto border border-(--clr-gray-200) bg-(--clr-gray-100) shadow-lg rounded-lg text-(--clr-gray-600)">
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
          <tr v-for="faq in faqs.data" :key="faq.id">
            <td class="p-4 border-b border-r border-(--clr-white)">{{ faq.question }}</td>
            <td class="p-4 border-b border-(--clr-white)">{{ faq.category.name }}</td>
            <td class="p-4 border-b border-r border-(--clr-white)">{{ new
              Date(faq.created_at).toLocaleDateString('de-DE',
                { day: '2-digit', month: '2-digit', year: 'numeric' }) }}</td>
            <td class="p-4 border-b border-(--clr-white) text-center">
              <div class="flex justify-center gap-3">
                <AdminActionButton @click.prevent="openEditModal(faq)" :icon="EditIcon" />
                <AdminActionButton @click.prevent="openConfirmDeleteModal(faq)" :icon="DeleteIcon" />
                <AdminActionButton @click="moveUp(faq.id)" :icon="MoveUpIcon" />
                <AdminActionButton @click="moveDown(faq.id)" :icon="MoveDownIcon" />
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <AdminPagination :links="faqs.links" />

    <!-- Begin Delete Modal -->
    <AdminModal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #header>
        <h2>Sind Sie sicher, dass Sie die folgende Frage löschen wollen?</h2>
      </template>
      <div v-if="selectedFaq" class="text-(--clr-gray-500) pt-4 pb-9">
        <p>Frage</p>
        <p class="font-bold text-xl">{{ selectedFaq.question }}</p>
      </div>
      <template #footer>
        <AppButton title="Abbrechen" :icon=CloseIcon class="bg-(--clr-gray-500) text-(--clr-white)"
          @click="showDeleteModal = false" />
        <AppButton title="Löschen" :icon=TrashIcon class="bg-(--clr-red-700) text-(--clr-white)" @click="deleteFaq" />
      </template>
    </AdminModal>
    <!-- End Delete Modal -->

    <!-- Begin Create Modal -->
    <AdminModal :show="showCreateModal" @close="showCreateModal = false">
      <template #header>
        <h2>Neue Frage erstellen</h2>
      </template>
      <p class="text-sm text-(--clr-gray-500) w-[60ch]">Füllen Sie die Felder für Frage und Antwort aus, wählen Sie eine
        Kategorie, vergeben Sie passende Schlagwörter und klicken Sie auf "Speichern".</p>
      <form @submit.prevent="createFaq">
        <div class="space-y-8 pt-7 pb-14">
          <div class="">
            <input type="text" v-model="form.question"
              class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)"
              required placeholder="Frage eingeben" />
            <p v-if="form.errors && form.errors.name" class="mt-1 text-sm text-(--clr-red-500)">
              {{ form.errors.name }}
            </p>
          </div>
          <div>
            <textarea v-model="form.answer"
              class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500) min-h-[100px]"
              required placeholder="Antwort eingeben"></textarea>
            <p v-if="form.errors && form.errors.answer" class="mt-1 text-sm text-(--clr-red-500)">
              {{ form.errors.answer }}
            </p>
          </div>
          <div class="flex gap-8">
            <div class="basis-2/3">
              <select v-model="selectedTag" @change="addTag()"
                class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)) h-auto">
                <option value="" disabled selected>Tag auswählen</option>
                <option v-for="tag in availableTags" :key="tag.id" :value="tag">
                  {{ tag.name }}
                </option>
              </select>
              <div class="mt-3 flex flex-wrap gap-2">
                <div v-for="(tag, index) in form.tags" :key="tag.id"
                  class="group p-2 mr-2 rounded-sm text-sm flex items-center bg-(--clr-darkgreen-500) text-(--clr-white) transition-colors">
                  {{ tag.name }}
                  <button @click="removeTag(index)" class="ml-3 fill-(--clr-white) group-hover:bg-(--clr-red-500)">
                    <component :is="RemoveIcon" class="size-5" />
                  </button>
                </div>
              </div>
            </div>
            <div>
              <select v-model="form.category_id"
                class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500))"
                required>
                <option value="" disabled selected>Kategorie auswählen</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>
          </div>
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

    <!-- Begin Edit Modal -->
    <AdminModal :show="showEditModal" @close="showEditModal = false">
      <template #header>
        <h2>Frage bearbeiten</h2>
      </template>
      <p class="text-sm text-(--clr-gray-500) w-[60ch]">Füllen Sie die Felder für Frage und Antwort aus, wählen Sie eine
        Kategorie, vergeben Sie passende Schlagwörter und klicken Sie auf "Speichern".</p>
      <form @submit.prevent="updateFaq">
        <div class="space-y-8 pt-7 pb-14">
          <div class="">
            <input type="text" v-model="form.question"
              class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)"
              required placeholder="Frage eingeben" />
            <p v-if="form.errors && form.errors.name" class="mt-1 text-sm text-(--clr-red-500)">
              {{ form.errors.name }}
            </p>
          </div>
          <div>
            <textarea v-model="form.answer"
              class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500) min-h-[100px]"
              required placeholder="Antwort eingeben"></textarea>
            <p v-if="form.errors && form.errors.answer" class="mt-1 text-sm text-(--clr-red-500)">
              {{ form.errors.answer }}
            </p>
          </div>
          <div class="flex gap-8">
            <div class="basis-2/3">
              <select v-model="selectedTag" @change="addTag()"
                class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500)) h-auto">
                <option value="" disabled selected>Tag auswählen</option>
                <option v-for="tag in availableTags" :key="tag.id" :value="tag">
                  {{ tag.name }}
                </option>
              </select>
              <div class="mt-3 flex flex-wrap gap-2">
                <div v-for="(tag, index) in form.tags" :key="tag.id"
                  class="group p-2 mr-2 rounded-sm text-sm flex items-center bg-(--clr-darkgreen-500) text-(--clr-white) transition-colors">
                  {{ tag.name }}
                  <button @click="removeTag(index)" class="ml-3 fill-(--clr-white) group-hover:bg-(--clr-red-500)">
                    <component :is="RemoveIcon" class="size-5" />
                  </button>
                </div>
              </div>
            </div>
            <div>
              <select v-model="form.category_id"
                class="w-full p-2 border border-(--clr-gray-200) focus:border-(--clr-darkgreen-500) focus:outline-none bg-(--clr-white) rounded-sm text-(--clr-gray-500))"
                required>
                <option value="" disabled selected>Kategorie auswählen</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>
          </div>
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

  </div>
</template>
