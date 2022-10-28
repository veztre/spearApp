<template>
  <Head title="About us"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      About us
    </template>

    <div class="p-4 bg-white rounded-lg shadow-xs">
     This is about the Spear Appication
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
