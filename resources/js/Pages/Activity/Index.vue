<template>
  <Head title="Activities"/>

  <BreezeAuthenticatedLayout>
  <template #header>
   Activity
  </template>



  <div class="p-4 bg-white rounded-lg shadow-xs">
    <div v-show="$page.props.flash.success"
         class="z-50">
        <Modal>
            <template v-slot:title>
                <p class="text-lg text-white">Success</p>
            </template>
            <template v-slot:message>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                    class="inline-block w-8 h-8 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>


                <span class="py-1 px-1 leading-none whitespace-nowrap text-lg
                                                        font-bold  text-green-500 rounded ml-2"> {{ $page.props.flash.success }} </span>
            </template>
        </Modal>
    </div>

    <div v-show="$page.props.flash.pageError" class="z-50">
        <Modal>
            <template v-slot:title>
                <p class="text-lg text-white">Confict of Schedule </p>
            </template>
            <template v-slot:message>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                    class="inline-block w-8 h-8 text-red-500">
                    <path s troke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>

                <span class="py-1 px-1 leading-none whitespace-nowrap text-lg
                                                font-bold  text-red-500 rounded ml-2"> {{ $page.props.flash.pageError }} </span>
            </template>
        </Modal>
    </div>



    <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
      <div class="px-4 py-4 -mx-3">
        <div class="mx-3">
          <span v-if="($page.props.auth.user.role).toLowerCase() == 'president'" class="font-semibold text-blue-500">
              <Link class=" px-6 py-2 mb-2 text-green-100 bg-green-500 rounded"
                    :href="route('activity.create')">
                    Create Activity
              </Link>
          </span>
        </div>
      </div>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
          <tr class="text-xs font-bold TableRowacking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3">Title</th>
            <th class="px-4 py-3">Venue</th>
            <th class="px-4 py-3">Target Date</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">View</th>
            <th class="px-4 py-3">Action</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y" >
          <TableRow v-for="activity in activities" :key="activity.id">

            <TableData>
              {{ activity.purpose }}
            </TableData>
            <TableData >
              {{ activity.venue }}
            </TableData>
            <TableData >
              {{ moment(activity.startDate).format("MM/DD/YYYY")  }} - {{ moment(activity.endDate).format("MM/DD/YYYY") }}
            </TableData>

            <TableData>
            <div v-if="`${activity.status}`=='for update'" class="text-red-600">
              {{ activity.status }}
            </div>
            <div v-else>
                {{ activity.status }}
            </div>
            </TableData>
            <TableData>
                <a :href="`/activity/${activity.id}/PDF`" target="_blank" class="px-2 py-2 inline-block bg-blue-600 text-white
                                                    text-xs leading-tight uppercase rounded shadow-md
                                                    hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                                    focus:outline-none focus:ring-0 active:bg-blue-800
                                                    active:shadow-lg transition duration-150 ease-in-out">
                    Request
                </a>
            </TableData>
            <TableData >
               <Link v-if="`${activity.status}` == 'for update' || `${activity.status}` == 'new' "  :href="`/activity/${activity.id}/edit`"
                                class="mr-2 px-2 py-2 inline-block bg-blue-600 text-white
                                    text-xs leading-tight uppercase rounded shadow-md
                                    hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                    focus:outline-none focus:ring-0 active:bg-blue-800
                                    active:shadow-lg transition duration-150 ease-in-out">
                    Update
                </Link>
                <Link v-if="`${activity.status}` == 'for update'" :href="`/activity/${activity.id}/viewComment`"
                                class="mr-2 p-2 inline-block bg-blue-600 text-white
                                    text-xs leading-tight uppercase rounded shadow-md
                                    hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
                                    focus:outline-none focus:ring-0 active:bg-blue-800
                                    active:shadow-lg transition duration-150 ease-in-out">
                View Comment
                </Link>

            </TableData>
          </TableRow>
          </tbody>
        </table>
      </div>
      <div
        class="px-4 py-3 text-xs font-semibold TableRowacking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">

      </div>
    </div>
  </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
  import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import Pagination from '@/Components/Pagination.vue';
  import { Head, Link } from '@inertiajs/inertia-vue3';
  import Button from '@/Components/SubmitButton.vue';
  import TableRow from '../../Components/TableRow.vue'
  import TableData from '@/Components/TableData.vue';
  import moment from "moment";
   import Modal from '@/Components/Modal.vue'
const props = defineProps({
    activities: Object
   })

</script>
