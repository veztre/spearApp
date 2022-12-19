<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder"
import BreezeNavLink from '@/Components/NavLink.vue'
import { Inertia } from "@inertiajs/inertia"
import Modal from "@/Components/Modal.vue"

defineProps(["users"])

function destroy(id) {
    if (confirm('Are you sure you want to delete this activity?')) {
        Inertia.delete(route("users.destroy", id));
    }
}
</script>

<template>

    <Head title="User" />
    <BreezeAuthenticatedLayout>
    <div v-show="$page.props.flash.success" class="z-50 h-5">
      <Modal>
            <template v-slot:title>
                <span class="font-semibold text-white">Success</span>
            </template>
            <template v-slot:message>
                <div class="px-4 py-2 mx-5">
                    <div class="mx-3">
                        <p class="text-lg text-gray-600">{{ $page.props.flash.success }}</p>
                    </div>
                </div>
            </template>
        </Modal>
    </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a class=" inline-block bg-blue-600 text-white
                                text-xs p-3 m-3 leading-tight uppercase rounded shadow-md
                                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                focus:outline-none focus:ring-0 active:bg-blue-800
                                active:shadow-lg transition duration-150 ease-in-out" :href="route('users.create')">
                        Create User
                    </a>
                    <div class="bg-white border-b border-gray-200">
                        <p class="text-2xl text-center">Users List </p>
                        <Table :resource="users" class="p-2">
                            <template #cell(actions)="{ item: user }">
                                <a class='inline-block bg-blue-600 text-white
                                          text-xs p-3 leading-tight uppercase rounded shadow-md
                                          hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                          focus:outline-none focus:ring-0 active:bg-blue-800
                                          active:shadow-lg transition duration-150 ease-in-out'
                                :href="`/users/${user.id}/edit`">
                                    Edit
                                </a>

                                <button @click="destroy(`${user.id}`)" class="inline-block bg-red-600 text-white
                                          text-xs p-3 mx-3 leading-tight uppercase rounded shadow-md
                                          hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg
                                          focus:outline-none focus:ring-0 active:bg-red-800
                                          active:shadow-lg transition duration-150 ease-in-out">
                                    Delete
                                </button>

                                <a class='inline-block bg-blue-600 text-white
                                                    text-xs p-3 leading-tight uppercase rounded shadow-md
                                                    hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                                    focus:outline-none focus:ring-0 active:bg-blue-800
                                                    active:shadow-lg transition duration-150 ease-in-out'
                                    :href="`/users/${user.id}/reset`">
                                    Reset
                                </a>
                                
                            </template>
                        </Table>
                    </div>
                </div>
            </div>

    </BreezeAuthenticatedLayout>
</template>
