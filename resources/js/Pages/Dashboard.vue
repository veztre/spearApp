<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>

        <template #header>
            Dashboard
        </template>
        <div v-show="$props.default_password" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-10 bg-orange-500">
                <SvgIcon>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </SvgIcon>
            </div>
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                <span class="font-semibold text-orange-500">Warning!!!</span>
                <p class="text-sm text-gray-600">Please Change your Password</p>
                </div>
            </div>
        </div>

        <div >
        <Carousel />
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import Carousel from '@/Components/Carousel.vue'
    import SvgIcon from '@/Components/SvgIcon.vue'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head } from '@inertiajs/inertia-vue3'
    import { Inertia } from "@inertiajs/inertia"

    import 'tw-elements';

 defineProps(['default_password'])
</script>
