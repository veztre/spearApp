<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Singnature
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="File">File Upload</label>
                                <input type="file" @change="previewImage" ref="sign_image" class="
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

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue"
import { Head } from "@inertiajs/inertia-vue3"
import { useForm } from "@inertiajs/inertia-vue3"
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,

    },
    props: {
        errors: Object,
    },
    data() {
        return {
            url: null,
        }
    },
    setup() {
        const form = useForm({
            sign_image: null,
        })

        return { form }
    },
    methods: {
        submit() {
            if (this.$refs.sign_image) {
                this.form.sign_image = this.$refs.sign_image.files[0]
            }
            this.form.post(route("signature.store"))
        },
        previewImage(e) {
            const file = e.target.files[0]
            this.url = URL.createObjectURL(file)
        },
    },
}
</script>
