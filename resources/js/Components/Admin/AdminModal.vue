<script setup>
import AppButton from '@/Components/AppButton.vue'

const props = defineProps({
    show: Boolean
})
</script>

<template>
    <Transition name="modal">
        <div v-if="show" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center">
            <div class="rounded-xl w-content p-[calc(var(--app-padding)*1.5)] bg-white min-w-[60ch]">
                <header class="flex justify-between items-start text-(--clr-darkgreen-500)">
                    <div class="w-[38ch]">
                        <slot name="header" />
                    </div>
                    <button
                        class="p-2 rounded-sm flex items-center justify-center cursor-pointer bg-(--clr-darkgreen-500)"
                        @click="$emit('close')">
                        <img src="/resources/assets/icons/icon-close.svg" alt="Close" class="w-6" />
                    </button>
                </header>

                <main class="py-[calc(var(--app-padding)*2)]">
                    <slot />
                </main>

                <footer class="flex justify-between">
                    <slot name="footer" />
                </footer>
            </div>
        </div>
    </Transition>
</template>
