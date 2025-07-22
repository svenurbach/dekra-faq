<script setup>
import AppButton from './AppButton.vue';
import iconMail from '@assets/icons/icon-email.svg';
</script>

<template>
    <div class="bg-(--clr-brightgreen-100) rounded-(--app-radius) px-[calc(var(--app-padding)*1.5)] py-[calc(var(--app-padding)*2)] my-[calc(var(--app-padding)*6)] flex items-center justify-between">
        <div>
            <p class="font-bold">Du findest keine Antwort auf deine Frage?</p>
            <p class="w-[48ch]">Nimm einfach Kontakt zu uns auf und wir versuchen so schnell wie möglich dir weiter zu helfen!</p>
        </div>
        <AppButton
        title="Schreibe uns"
        :icon=iconMail
        href="/contact"
        class="bg-(--clr-brightgreen-700) text-(--clr-brightgreen-100)"
        />
    </div>
</template>
