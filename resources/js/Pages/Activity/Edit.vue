<template>
  <Head title="Activity"/>

  <BreezeAuthenticatedLayout>
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
          <span class="font-semibold text-blue-500">Edit Activity</span>
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

    <div class="overflow-hidden ma-8   bg-red-200 rounded-lg border shadow-xs">
      <div class="overflow-x-auto  mx-8 ">
              <form @submit.prevent="update">
                <BreezeLabel for="name" value="Venue"/>
                <Label for="name" value="Venue" />
                <select name="venue" v-model="form.venue" class="block w-full rounded-lg">
                    <option :value='form.venue'>{{form.venue}} </option>
                    <option value="Amphitheater - CEAFA Building 4th floor">Amphitheater - CEAFA Building 4th floor</option>
                    <option value="AVP Room - CIT Building Ground Floor">AVP Room - CIT Building Ground Floor</option>
                    <option value="Gymnasium - BatStateU Alangilan Campus">Gymnasium - BatStateU Alangilan Campus</option>
                    <option value="Virtual or Online Event">Virtual or Online Event</option>
                </select>
                 <BreezeLabel for="name" value="Purpose"/>
                  <TextareaAutoresize
                     class="block w-full rounded-lg"
                      name="purpose"
                      v-model="form.purpose"
                  />
                  <BreezeLabel for="status" value="Status"/>
                  <select name="status" v-model="form.status" class="block w-full rounded-lg" >
                    <option :value='form.status'>{{form.status}} </option>
                    <option value="new">New</option>
                    <option value="for approval - office of the student organization">for approval - office of the student organization</option>
                  </select>
                  <BreezeLabel for="startDate "  value="Start Date"/>
                  <BreezeInput
                      type="datetime-local"
                      v-model="form.startDate"


                  />

                  <BreezeLabel for="endDate "  value="End Date"/>
                  <BreezeInput
                      type="datetime-local"
                      v-model="form.endDate"

                  />
                  <BreezeInput type="file" @input="form.attachment = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                              {{ form.progress.percentage }}%
                       </progress>
                  <hr/>

                  <a type="button" class="text-white p-2 my-10 bg-blue-500 rounded shadow-md
                                          hover:bg-blue-700 hover:shadow-lg"
                    :href="`/activity/${form.id}/viewAttachment`">
                         View Attachment
                  </a>

                  <Button class=" m-10 bg-red-500 rounded
                                hover:bg-red-700 hover:shadow-lg"
                     tabindex="-1" type="button" @click="destroy">
                    Delete Activity
                  </Button>
                  <Button>
                    Update
                  </Button>
               </form>
        </div>
      </div>
  </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
  import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import { Head } from '@inertiajs/inertia-vue3';
  import Button from '@/Components/SubmitButton.vue';
  import BreezeInput from '@/Components/Input.vue';
  import BreezeLabel from '@/Components/Label.vue';
  import { ref,reactive } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
import ValidationErrors from '@/Components/ValidationErrors.vue';
  import SvgIcon from '@/Components/SvgIcon.vue';
import TextareaAutoresize from '@/Components/TextareaAutoresize.vue'

   const props = defineProps({
      activity: Object
  })

  const form= reactive({
            _method: 'put',
            id:props.activity.id,
            purpose: props.activity.purpose,
            venue: props.activity.venue,
            endDate: props.activity.endDate,
            startDate: props.activity.startDate,
            status: props.activity.status,
            attachment:props.activity.attachment
        })
  function update() {
        Inertia.post(`/activity/${props.activity.id}`, {
            _method: 'put',
            purpose: form.purpose,
            venue: form.venue,
            priority:form.priority,
            endDate: form.endDate,
            startDate: form.startDate,
            status:  form.status,
            attachment: form.attachment,
            id: props.activity.id
        })
  }

  function destroy() {
        if (confirm('Are you sure you want to delete this activity?')) {
          Inertia.delete(`/activity/${props.activity.id}`)
        }
      }
 </script>
