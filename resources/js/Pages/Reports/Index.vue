

<template>
   <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Activity
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <h3 class="text-2xl text-center">Generate PDF Report</h3>
                        <div class="overflow-x-auto  my-8 ">
                             <div class="flex mx-5" >
                                <Label for="startDate " value="Start Date" class="w-1/8   rounded-lg"/>
                                <Input type="datetime-local" class="w-1/8   rounded-lg" v-model="startDate" />
                                <Label for="endDate " value="End Date" class="w-1/8   rounded-lg"/>
                                <Input type="datetime-local" class="w-1/8   rounded-lg" v-model="endDate"  />
                             </div>
                            <div class="flex mx-5">
                                <Label for="status" value="Status" class="w-1/4"  />
                                <select v-model="status" class="w-1/8 mt-5  rounded-lg">
                                    <option value="all">All</option>
                                    <option value="new">New</option>
                                    <option value="for update">for update</option>
                                    <option value="for approval-student body">For Approval-Student Body</option>
                                    <option value="for approval-dean">For Approval-deean</option>
                                    <option value="for approval-chancellor">For Approval-chancellor</option>
                                </select>

                            <a :href="'/generate-activity-report/' + status + '/' + startDate + '/' + endDate "
                            target="_blank" class="px-2 py-2 inline-block bg-blue-600 text-white
                                                                  text-xs leading-tight uppercase rounded shadow-md
                                                                  hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                                                  focus:outline-none focus:ring-0 active:bg-blue-800
                                                                  active:shadow-lg transition duration-150 ease-in-out">
                                View
                            </a>

                            </div>

                        </div>
                </div>


                <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-2xl text-center">Activity List</h3>
                        <Table :resource="activities">
                        </Table>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder"
import BreezeNavLink from '@/Components/NavLink.vue'
import { Inertia } from "@inertiajs/inertia"
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import Button from '@/Components/SubmitButton.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import { ref, reactive } from 'vue'

defineProps(["activities"])

const status = ref("");
const startDate = ref(null);
const endDate = ref(null);



const activity = ref(Object)

function goto(status){

  console.log(status)

}

</script>
