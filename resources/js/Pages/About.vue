<template>

    <Head title="About Us" />

    <BreezeAuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div v-show="$page.props.flash.success"
            class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
                </div>
            </div>
        </div>



        <div class="flex  flex-row  space-x-4">
            <div class="">
                <img class="max-w-full h-auto rounded-lg" src="/images/spear.png" />
            </div>
            <div class="py-2">
                <h1 class="text-2xl text-red-400 "> Spear Application </h1>
                <p> for the student organizations at Batangas State University – Alangilan Campus. This is
                    to assist the local student organizations in handling data processes of the
                    administrative offices with a faster and more efficient platform. </p>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
}
</script>
