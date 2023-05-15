<template>

    <Head title="Activities" />

    <BreezeAuthenticatedLayout>
        <template #header>
            Schedule
        </template>



        <div class="p-4 bg-white rounded-lg shadow-xs">

            <div v-if="showSchedule" class="z-50">
                <Modal >
                    <template v-slot:title>
                        <p class="text-lg text-white">Activity Schedule</p>
                    </template>

                    <template v-slot:message>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="inline-block w-8 h-8 text-red-500">
                            <path s troke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>

                        <span class="py-1 px-1 leading-none whitespace-nowrap text-lg
                                                font-bold  text-red-500 rounded ml-2">{{ activity.id }} </span>
                    </template>

                    <template v-slot:button>
                    <button type="button" @click="showSchedule=false" class=" inline-block  px-3 py-3 bg-blue-600
                                                            text-white font-medium text-xs leading-tight
                                                            uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                                                            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                                            active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Close</button>
                    </template>
                </Modal>
            </div>



            <div class="inline-flex overflow-hidden w-full bg-white rounded-lg shadow-md">
                <div class="px-4 py-4 -mx-3">
                    sdsf
                </div>
            </div>

            <div class=" overflow-hidden rounded-lg border w-full shadow-xs flex flex-wrap">
                <div v-for="activity in activities" :key="activity.id">
                         <div class="m-2 inline-block bg-gray-400 block p-3 rounded-lg shadow-lg bg-white max-w-sm">
                            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Venue: {{ activity.venue }}</h5>
                            <p class="text-gray-700 text-base mb-4">
                             Start: {{ moment(activity.startDate).format("MM/DD/YYYY") }}
                                   - {{ moment(activity.startDate).format("hh:mm A") }}
                            </p>
                            <p class="text-gray-700 text-base mb-4">
                            End: {{ moment(activity.endDate).format("MM/DD/YYYY") }}
                            - {{ moment(activity.endDate).format("hh:mm A") }}

                            </p>
                            <button type="button" @click="viewActivity(`${activity.id}`)"
                                class=" inline-block  px-3 py-3 bg-blue-600
                                        text-white font-medium text-xs leading-tight
                                        uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        View</button>
                        </div>


                </div>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Modal from '@/Components/Modal.vue'
import moment from "moment"
import { ref,reactive, computed } from 'vue'

const props = defineProps({
    activities: Object,

})

const activity = reactive({
    id: 0,
    purpose: "",


})

const showSchedule = ref(false);
const id = ref(0);



function viewActivity(id) {

    showSchedule.value = true
    const act = Object.values(props.activities).f

    console.log(activity);




}



</script>
