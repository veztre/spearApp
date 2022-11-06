<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder"
import BreezeNavLink from '@/Components/NavLink.vue'
import { Inertia } from "@inertiajs/inertia"
defineProps(["users"])

function destroy(id) {
    if (confirm('Are you sure you want to delete this activity?')) {
        Inertia.delete(route("users.destroy", id));
    }
}
</script>

<template>

    <Head title="Dashboard" />


    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <a class=" inline-block bg-blue-600 text-white
                                text-xs p-3 m-3 leading-tight uppercase rounded shadow-md
                                hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                focus:outline-none focus:ring-0 active:bg-blue-800
                                active:shadow-lg transition duration-150 ease-in-out" :href="route('users.create')">
                        Create User
                    </a>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-2xl text-center">Users List </h3>
                        <Table :resource="users">
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
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
