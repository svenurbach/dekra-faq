<script setup>
import CompanyLogo from '@/Components/CompanyLogo.vue'
import { Link } from '@inertiajs/vue3';
import AppButton from '@/Components/AppButton.vue'
import icon from '../../assets/icons/icon-arrow-circle-right.svg';
</script>

<template>
    <div class="fixed w-full bg-(--clr-darkgreen-500)/70 z-20">
        <div class="main-w flex items-center justify-between p-[calc(var(--app-padding)*2)]">
            <CompanyLogo />
            <nav>
                <ul class="flex items-center gap-[calc(var(--app-padding)*2)]">
                    <li>
                        <Link href="/">FAQ</Link>
                    </li>
                    <li>
                        <Link href="/login">
                        <AppButton title="Login" :icon="icon"
                            class="text-(--clr-darkgreen-500) bg-(--clr-brightgreen-300)" />
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
