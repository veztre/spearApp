<template>
  <Head title="Dashboard"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      Dashboard
    </template>

     <div class="flex  flex-row  space-x-4">
        <div class="">
            <img class="max-w-full h-auto rounded-lg" src="/images/spear.png"  />
        </div>
        <div class="py-2">
              <h1 class="text-2xl text-red-400 " > Spear Application </h1>
              <p> for the student organizations at Batangas State University – Alangilan Campus. This is 
                  to assist the local student organizations in handling data processes of the 
                  administrative offices with a faster and more efficient platform. </p>
        </div>
    </div>  
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head,
  },
};
</script>
