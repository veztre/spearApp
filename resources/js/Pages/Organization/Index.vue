<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
               Organization
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button
                            class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                " v-on:click.prevent="update">
                            Update

                        </button>
                        <table class="w-full">
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td colspan='2' class="px-4 py-2">Your Organization Details</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2">
                                        <img  :src="showImage() + organization.logo" class="object-cover h-40 w-80" />
                                    </td>
                                    <td class="px-4 py-2">
                                          <form @submit.prevent="submit">
                                            <Label for="name" value="Name"/>
                                               <Input  v-model="form.name"  type="text" />
                                            <Label for="department" value="Department" />
                                               <Input type="text" v-model="form.department"  />
                                            <label for="File">File Upload</label>
                                            <input type="file" @change="previewImage" @input="form.logo = $event.target.files[0]" class="
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

                                          </form>
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
import { Head,Link } from "@inertiajs/inertia-vue3"
import Label from '@/Components/Label.vue'
import { reactive, ref } from 'vue'
import Input from '@/Components/Input.vue';
import { Inertia } from '@inertiajs/inertia'

const url = ref('null')
const fileSelected= ref(0)

const props = defineProps({
    organization: Object
})

const form = reactive({
    _method: 'put',
    name: props.organization.name,
    department: props.organization.department,

})


function update() {
    Inertia.post(`/organization/${props.organization.id}`, {
        _method: 'put',
        name: form.name,
        department: form.department,
        logo: form.logo,
    })
}
function showImage() {
    return "/storage/"
}

function previewImage(e) {
    const file = e.target.files[0]
    url.value = URL.createObjectURL(file)
}


</script>
