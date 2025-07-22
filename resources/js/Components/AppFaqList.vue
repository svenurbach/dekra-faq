<script setup>
import AppAccordion from '@/Components/AppAccordion.vue';

defineProps({
    faqs: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div>
        <ul>
            <li v-for="faq in faqs" :key="faq.id" class="mb-(--app-padding)">
                <AppAccordion :title="faq.question" :ariaTitle="faq.question">
                    <p>{{ faq.answer }}</p>
                </AppAccordion>
            </li>
        </ul>
    </div>
</template>
