<script setup>
import CompanyLogo from '@/Components/CompanyLogo.vue'
import { usePage, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue'
import AppButton from '@/Components/AppButton.vue'
import IconArrowRight from '@icons/icon-arrow-circle-right.svg';
import IconArrowLeft from '@icons/icon-arrow-circle-left.svg';
import IconMenu from '@icons/icon-bars.svg';
import IconClose from '@icons/icon-close.svg';
import { route } from 'ziggy-js';

const user = usePage().props.auth.user
const currentRoute = computed(() => usePage().url)

const isActive = (path) => {
    return currentRoute.value === path
}

const mobileMenuOpen = ref(false)
const toggleMobileMenu = () => {
    mobileMenuOpen.value = !mobileMenuOpen.value
}
</script>

<template>
    <div class="fixed w-full bg-(--clr-darkgreen-500)/70 backdrop-blur-sm z-20">
        <div class="main-w flex items-center justify-between p-[calc(var(--app-padding)*2)]">
            <CompanyLogo />
            <div class="grow md:hidden"></div>
            <button class="md:hidden p-3 size-10 cursor-pointer bg-(--clr-brightgreen-200) fill-(--clr-darkgreen-500) rounded-md"
                @click="toggleMobileMenu">
                <component :is="mobileMenuOpen ? IconClose : IconMenu" alt="Menu" />
            </button>
            <nav :class="mobileMenuOpen ? 'block' : 'hidden md:block'">
                <ul :class="mobileMenuOpen ? 'absolute left-0 top-full w-full flex-col pb-6 items-center gap-6 bg-(--clr-darkgreen-500)/70' : 'items-center gap-[calc(var(--app-padding)*2)] text-(--clr-gray-300)'" class="flex text-(--clr-gray-300)">
                    <li>
                        <Link href="/" :class="{ 'text-(--clr-brightgreen-200) font-bold': isActive('/') }"
                            class="text-xl">
                            FAQ
                        </Link>
                    </li>
                    <li v-if="user?.is_admin">
                        <Link href="/admin/tags"
                            :class="{ 'text-(--clr-brightgreen-200) font-bold': isActive('/admin/tags') }"
                            class="text-xl">
                            Tags
                        </Link>
                    </li>
                    <li v-if="user?.is_admin">
                        <Link href="/admin/faqs"
                            :class="{ 'text-(--clr-brightgreen-200) font-bold': isActive('/admin/faqs') }"
                            class="text-xl">
                            Fragen
                        </Link>
                    </li>
                    <li v-if="!user?.is_admin">
                        <Link href="/login">
                            <AppButton title="Login" :icon="IconArrowRight"
                            class="bg-(--clr-brightgreen-200) text-(--clr-darkgreen-500)" />
                        </Link>
                    </li>
                    <li v-else>
                        <Link :href="route('logout')" method="post">
                            <AppButton title="Logout" :icon="IconArrowLeft"
                            class="bg-(--clr-brightgreen-200) text-(--clr-darkgreen-500)" />
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
