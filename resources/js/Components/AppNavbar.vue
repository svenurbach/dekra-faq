<script setup>
import CompanyLogo from '@/Components/CompanyLogo.vue'
import { usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue'
import AppButton from '@/Components/AppButton.vue'
import IconArrowRight from '@icons/icon-arrow-circle-right.svg';
import IconArrowLeft from '@icons/icon-arrow-circle-left.svg';
import { route } from 'ziggy-js';

const user = usePage().props.auth.user
const currentRoute = computed(() => usePage().url)

const isActive = (path) => {
    return currentRoute.value === path
}
</script>

<template>
    <div class="fixed w-full bg-(--clr-darkgreen-500)/70 z-20">
        <div class="main-w flex items-center justify-between p-[calc(var(--app-padding)*2)]">
            <CompanyLogo />
            <nav>
                <ul class="flex items-center gap-[calc(var(--app-padding)*2)] text-(--clr-gray-300)">
                    <li>
                        <Link href="/" :class="{ 'text-(--clr-brightgreen-300) font-bold': isActive('/') }">
                        FAQ
                        </Link>
                    </li>
                    <li v-if="user?.is_admin">
                        <Link  href="/admin/tags" :class="{ 'text-(--clr-brightgreen-300) font-bold': isActive('/admin/tags') }">Tags</Link>
                    </li>
                    <li v-if="user?.is_admin">
                        <Link  href="/admin/faqs" :class="{ 'text-(--clr-brightgreen-300) font-bold': isActive('/admin/faqs') }">Fragen</Link>
                    </li>
                    <li v-if="!user?.is_admin">
                        <Link href="/login">
                            <AppButton title="Login" :icon="IconArrowRight"
                            class="bg-(--clr-brightgreen-300) text-(--clr-darkgreen-500)" />
                        </Link>
                    </li>
                    <li v-else>
                        <Link :href="route('logout')" method="post">
                            <AppButton title="Logout" :icon="IconArrowLeft"
                            class="bg-(--clr-brightgreen-300) text-(--clr-darkgreen-500)" />
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
