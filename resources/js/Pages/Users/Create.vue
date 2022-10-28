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
            <span class="font-semibold text-blue-500">Create User</span>
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
                <form @submit.prevent="submit">
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
                        <option selected value="">Choose...</option>
                        <option value="admin">Admin</option>
                        <option value="dean">Dean Office</option>
                        <option value="adviser">Adviser</option>
                        <option value="student">Student</option>
                    </select>
                    <BreezeLabel for="email" value="Email"/>
                    <BreezeInput
                        type="email"
                        v-model="form.email"
                        class="block w-full my-5"
                        required
                    />
                    <hr class="my-8 h-px bg-gray-200 border-0 dark:bg-gray-700">
                    <h1 class="text-3xl pb-4">Organization</h1> 

                    <BreezeLabel for="name" value="Name"/>
                    <BreezeInput
                        type="text"
                        v-model="form.name"
                        class="block w-full my-5"
                    />
                    <BreezeLabel for="department" value="Department"/>
                    <select name="department" v-model="form.department" class="block w-full my-5 rounded-lg" >
                        <option selected value="">Choose...</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Business">Business</option>
                        <option value="IT">IT</option>
                        <option value="Nursing">Nursing</option>
                    </select>
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
                first_name: "",
                last_name:"",
                email: "",
                role:"",
                name: "",
                password:'password',
                department:""
            }),
        };
    },
  
    props: {
      users: Object,
    },
     
    methods: {
        submit() {
            this.form.post(this.route("users.store"));
        },
    },

  }
  </script>
  