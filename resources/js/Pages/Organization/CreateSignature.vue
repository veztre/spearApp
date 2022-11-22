<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Signature
            </h2>
        </template>
        <div v-show="$page.props.flash.success" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
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

        <BreezeValidationErrors class="mb-4" />

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="File">File Upload</label>
                                <input type="file" @change="previewImage" @input="form.sign_image = $event.target.files[0]" class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    " />
                                <img v-if="url" :src="url" class="w-full mt-4 h-80" />
                                <div v-if="errors.image" class="font-bold text-red-600">
                                    {{ errors.image }}
                                </div>
                            </div>

                            <div class="flex items-center mt-4">
                                <button class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    ">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue"
import { Head } from "@inertiajs/inertia-vue3"
import { useForm } from "@inertiajs/inertia-vue3"
import { defineProps,ref } from "vue"
import { Inertia } from '@inertiajs/inertia'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

const form = useForm({
            sign_image: null,

})
const url = ref(null)

const props = defineProps({
        signUser: Object,
        errors: Object
})
function submit() {
        form.post(`/storeSignature/${props.signUser.id}`, {
    })

}

function previewImage(e) {
    const file = e.target.files[0]
    url.value = URL.createObjectURL(file)
}

</script>
