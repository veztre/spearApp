<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            Dashboard
        </template>
        <div>
        <Carousel />
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import Carousel from '@/Components/Carousel.vue'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head } from '@inertiajs/inertia-vue3'
    import 'tw-elements';
</script>
