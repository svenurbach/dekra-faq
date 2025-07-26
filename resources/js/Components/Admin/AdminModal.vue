<script setup>
import CloseIcon from '@icons/icon-close.svg'

const props = defineProps({
    show: Boolean
})
</script>

<template>
    <Transition name="modal">
        <div v-if="show" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center">
            <div class="rounded-xl w-content p-[calc(var(--app-padding)*1.5)] bg-(--clr-gray-100) min-w-[60ch]">
                <header class="flex justify-between items-start text-(--clr-darkgreen-500)">
                    <div class="w-[38ch]">
                        <slot name="header" />
                    </div>
                    <button
                        class="size-9 rounded-sm flex items-center justify-center cursor-pointer bg-(--clr-darkgreen-500)"
                        @click="$emit('close')">
                        <component :is="CloseIcon" alt="Close" class="p-2 fill-(--clr-white)" />
                    </button>
                </header>

                <main>
                    <slot />
                </main>

                <footer class="flex justify-between">
                    <slot name="footer" />
                </footer>
            </div>
        </div>
    </Transition>
</template>
