<template>
  <Head title="Users"/>

  <BreezeAuthenticatedLayout>
  <template #header>
    Users
  </template>

  <div class="p-4 bg-white rounded-lg shadow-xs">
    <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
      <div class="flex justify-center items-center w-12 bg-blue-500">
        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <path
              d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
        </svg>
      </div>

      <div class="px-4 py-2 -mx-3">
        <div class="mx-3">
          <span class="font-semibold text-blue-500">
              <BreezeNavLink :href="route('users.create')">
               Create User
              </BreezeNavLink>
          </span>
           <p class="text-sm text-gray-600 text-right">User List</p>
        </div>
      </div>
    </div>

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
      <div class="overflow-x-auto w-full">
        <table class="w-full whitespace-no-wrap">
          <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
            <th class="px-4 py-3">Firstname</th>
            <th class="px-4 py-3">Lastname</th>
            <th class="px-4 py-3">Role</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y">
          <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
            <td class="px-4 py-3 text-sm">
              {{ user.last_name }}
            </td>
            <td class="px-4 py-3 text-sm">
              {{ user.first_name }}
            </td>
            <td class="px-4 py-3 text-sm">
              {{ user.role }}
            </td>
          
            <TableData >
                <Link :href="`/users/${user.id}/edit`"
                class="px-2 py-2 inline-block bg-blue-600 text-white 
                       text-xs leading-tight uppercase rounded shadow-md 
                       hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg 
                      focus:outline-none focus:ring-0 active:bg-blue-800 
                      active:shadow-lg transition duration-150 ease-in-out">
                   View
              </Link>
           </TableData>       
          </tr>
          </tbody>
        </table>
      </div>
      <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination :links="users.links" />
      </div>
    </div>
  </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Button from '@/Components/SubmitButton.vue'; 
import BreezeNavLink from '@/Components/NavLink.vue'
import TableData from '@/Components/TableData.vue';
export default {
  components: {
    BreezeAuthenticatedLayout,
    Pagination,
    Head,
    Link,
    BreezeNavLink,
    Button,
    TableData
},
  props: {
    users: Object,
    organizations: Object
  }
}
</script>
