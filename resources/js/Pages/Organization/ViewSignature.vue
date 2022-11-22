<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Image Index
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <a class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                " :href= "`/officers/${user.id}/updateSignature`">
                           Update
                            </a>
                        </div>
                            <table class="w-full">
                                <thead class="font-bold bg-gray-300 border-b-2">
                                    <td class="px-4 py-2">Your Save Signature</td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 py-2">
                                            <img :src="showImage() + signature.sign_image" class="object-cover h-40 w-80" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue"
import BreezeNavLink from "@/Components/NavLink.vue"
import { Head, Link } from "@inertiajs/inertia-vue3"


function  showImage() {
            return "/storage/"
}

defineProps({
    signature: Object,
    user: Object
})
</script>

