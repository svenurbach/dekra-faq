<script setup>
import { ref } from 'vue';

const props = defineProps({
    title: { type: String, required: true },
});

const show = ref(false);
const toggle = (event) => {
    show.value = !show.value;
}
</script>

<template>
    <div class="rounded-(--app-radius) py-(--app-padding) px-[calc(var(--app-padding)*1.5)] border-1 border-(--clr-gray-200)"
        :class="show ? 'bg-(--clr-darkgreen-500) text-(--clr-white)' : 'bg-(--clr-gray-100) text-(--clr-darkgreen-500)'">
        <div @click.prevent="toggle" class="flex items-center justify-between cursor-pointer">
            {{ title }}
            <div class="w-[40px] rounded-full p-2.5"
                :class="show ? 'bg-(--clr-brightgreen-200)' : 'bg-(--clr-darkgreen-500)'">
                <svg viewBox="0 0 49 49" xmlns="http://www.w3.org/2000/svg"
                    :class="show ? 'fill-(--clr-darkgreen-500)' : 'fill-(--clr-gray-100) rotate-180'">
                    <path
                        d="M4.2091 35.501C3.47491 36.1663 2.28484 36.1663 1.55064 35.501C0.816456 34.8356 0.816456 33.7572 1.55064 33.0918L23.1708 13.499C23.905 12.8337 25.095 12.8337 25.8292 13.499L47.4494 33.0918C48.1835 33.7572 48.1835 34.8356 47.4494 35.501C46.7152 36.1663 45.5251 36.1663 44.7909 35.501L24.5 17.1128L4.2091 35.501Z" />
                </svg>
            </div>
        </div>
        <div class="bg-(--clr-darkgreen-500) w-3/4 py-(--app-padding)" v-if="show">
            <slot />
        </div>
    </div>
</template>
