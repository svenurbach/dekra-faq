<script setup>
import AppButton from './AppButton.vue';
import IconMail from '@icons/icon-email.svg';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-(--clr-brightgreen-100) rounded-(--app-radius) px-[calc(var(--app-padding)*1.5)] py-[calc(var(--app-padding)*2)] my-[calc(var(--app-padding)*6)] flex flex-col md:flex-row items-center justify-between">
        <div>
            <p class="font-bold">Du findest keine Antwort auf deine Frage?</p>
            <p class="md:w-[48ch]">Nimm einfach Kontakt zu uns auf und wir versuchen so schnell wie möglich dir weiter zu helfen!</p>
        </div>
        <a href="mailto:mail@example.org" class="text-center mt-6 md:mt-0">
            <AppButton
            title="Schreibe uns"
            :icon="IconMail"
            class="bg-(--clr-darkgreen-700) text-(--clr-brightgreen-100)"
            />
        </a>
    </div>
</template>
