<template>
  <Head title="Activity"/>

  <AuthenticatedLayout>
  <template #header>
    Activity
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
          <span class="font-semibold text-blue-500">Create Activity</span>
        </div>
      </div>
    </div>
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

    <ValidationErrors class="mb-4"/>


    <div class="overflow-hidden ma-8 w-100
                bg-red-200 rounded-lg border shadow-xs">
      <div class="overflow-x-auto  mx-8 ">
              <form @submit.prevent="submit">
                <Label for="name" value="Venue"/>
                  <Input
                      id="name"
                      v-model="form.venue"
                      type="text"
                  />
                 <Label for="purpose" value="Purpose"/>
                  <TextareaAutoresize
                      class="block w-full rounded-lg"
                      id="purposee"
                      v-model="form.purpose"

                  />
                  <Label for="status" value="Status"/>
                  <select name="status" v-model="form.status" class="block w-full rounded-lg" >
                      <option value="new">New</option>
                      <option value="for approval-student body">For Approval-Student Body</option>
                  </select>

                  <Label for="startDate "  value="Start Date"/>
                  <Input
                      type="datetime-local"
                      v-model="form.startDate"
                      required
                  />

                  <Label for="endDate "  value="End Date"/>
                  <Input
                      type="datetime-local"
                      v-model="form.endDate"
                      required
                  />
                  <Label for="attachment " value="Attachment" />
                  <Input id="attachment" type="file" @input="form.attachment = $event.target.files[0]" />
                  <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                     </progress>

                 <Button>
                      Submit
                  </Button>

              </form>
        </div>
      </div>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
  import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import { Head } from '@inertiajs/inertia-vue3';
  import Button from '@/Components/SubmitButton.vue';
  import Input from '@/Components/Input.vue';
  import Label from '@/Components/Label.vue';
  import ValidationErrors from '@/Components/ValidationErrors.vue';
  import { Inertia } from '@inertiajs/inertia'
  import { reactive,ref } from 'vue'
  import TextareaAutoresize from '@/Components/TextareaAutoresize.vue'

  const form=reactive({
      purpose: "",
      status: "",
      venue:"",
      priority:"",
      startDate: "",
      endDate: "",
      attachment: null,
  })
  const activity= ref(Object)

  function submit() {
      Inertia.post(route("activity.store"),form);
  }
  </script>
