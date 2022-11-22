<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
               Organization
            </h2>
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
    <BreezeValidationErrors class="mb-4"/>


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
                                        <img  :src="showImage()+organization.logo" class="object-cover h-40 w-80" />
                                    </td>
                                    <td class="px-4 py-2">
                                          <form @submit.prevent="submit">
                                            <Label for="name" value="Name"/>
                                            <Input  v-model="form.name"  type="text" />
                                            <Label for="acronym" value="Acronym" />
                                            <div class="mb-3 xl:w-96">
                                                <Input v-model="form.acronym"
                                                        class="appearance-none block w-full  px-3 py-1.5 text-base font-normal
                                                        text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
                                                        rounded transition ease-in-out m-0
                                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">

                                                </Input>
                                            </div>
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
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

const url = ref('null')


const props= defineProps({
    organization: Object
})

const form = reactive({
    _method: 'put',
    name: props.organization.name,
    acronym: props.organization.acronym,

})


function update() {
    Inertia.post(`/organization/${props.organization.id}`, {
        _method: 'put',
        name: form.name,
        acronym: form.acronym,
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
