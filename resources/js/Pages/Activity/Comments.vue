<template>
  <Head title="Activities"/>
  <BreezeAuthenticatedLayout>
    <div class="p-4 bg-white rounded-lg shadow-xs">
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

    <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
        <div v-for="comment in comments" :key="comment.id" class="flex justify-left  w-full">
            <div class="block rounded-lg shadow-lg bg-white max-w-sm text-center">
                <div class="py-3 px-6 border-b border-gray-300">
                    Comment by {{comment.fullname}} on Activity # {{comment.activity_id}}
                </div>
                <div class="p-6 ">
                        <p class="text-gray-700 text-base mb-4">
                        {{comment.comment}}
                    </p>
                    </div>
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    Date: {{comment.updated_at}}
                </div>
            </div>
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


const props = defineProps({
    comments: Object
   })

</script>
