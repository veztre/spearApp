<template>
  <Head title="Users"/>

  <BreezeAuthenticatedLayout>
  <template #header>
    Organization Officer
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
          <span class="font-semibold text-blue-500">Edit Officer</span>
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

    <BreezeValidationErrors class="mb-4"/>

    <div class="overflow-hidden ma-8 w-full  bg-red-200 rounded-lg border shadow-xs">
      <div class="overflow-x-auto  mx-8 w-3/4">
          <form @submit.prevent="update">
                 <BreezeLabel class="block w-1/2 mt-5" for="name" value="First Name"/>
                  <BreezeInput
                      id="name"
                      v-model="form.first_name"
                      type="text"
                      class="block w-full my-5"

                  />
                  <BreezeLabel class="block w-1/2 mt-5" for="name" value="Last Name"/>
                  <BreezeInput
                      id="name"
                      v-model="form.last_name"
                      type="text"
                      class="block w-full my-5"

                  />
                  <BreezeLabel for="role" value="Role"/>
                  <select name="role" v-model="form.role" class="block w-full my-5 rounded-lg" >
                    <option :value='form.role'>{{form.role}} </option>
                    <option selected value="president"> Org President</option>
                    <option selected value="student body">Student Organization</option>
                    <option value="chancellor">Chancellor</option>
                    <option value="dean">Dean </option>
                  </select>
                  <div v-if="form.role=='' || form.role!='president'">
                     <BreezeLabel for="Salutation" value="Salutation"/>
                    <select name="salutation" v-model="form.salutation" class="block w-full my-5 rounded-lg" >
                       <option :value='form.salutation'>{{form.salutation}} </option>
                      <option selected value="Mr.">Mr</option>
                      <option selected value="Ms.">Ms</option>
                      <option value="Prof.">Prof</option>
                      <option value="Dr.">Dr</option>
                    </select>
                 </div>
                  <BreezeLabel for="email" value="Email"/>
                  <BreezeInput
                      type="email"
                      v-model="form.email"
                      class="block w-full my-5"
                      required
                      readonly
                  />

                  <Button class="block  my-5">
                      Submit
                  </Button>

            </form>
        </div>
      </div>
  </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
  import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import Pagination from '@/Components/Pagination.vue';
  import { Head } from '@inertiajs/inertia-vue3';
  import Button from '@/Components/SubmitButton.vue';
  import BreezeInput from '@/Components/Input.vue';
  import BreezeLabel from '@/Components/Label.vue';
  import BreezeValidationErrors from '@/Components/ValidationErrors.vue';


  export default {
    components: {
    BreezeAuthenticatedLayout,
    BreezeValidationErrors,
    Pagination,
    Head,
    Button,
    BreezeInput,
    BreezeLabel,
    Button
    },
    data() {
        return {
          form: this.$inertia.form({
         _method: 'put',
                first_name: this.user.first_name,
                last_name:this.user.last_name,
                email: this.user.email,
                role: this.user.role,
                salutation:this.user.salutation,
            }),
        };
    },

    props: {
      user: Object,
    },
      methods: {
     update() {
       this.form.put(`/officers/${this.user.id}`, {
       })
     },
   },

  }
  </script>
