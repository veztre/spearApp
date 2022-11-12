<template>
  <Head title="Dashboard"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      Dashboard
    </template>

    <div v-show="$page.props.flash.success" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
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
    <div class="flex flex-row">
        <div class="basis-1/2">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <BarChart :chart-data="chartData" />
                    </div>
                </div>
            </div>
        </div>
        <div class="basis-1/2">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <BarChart :chart-data="monthData" />
                        </div>
                    </div>
            </div>
        </div>

    </div>

  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BarChart from '@/Pages/Chart/BarChart.vue'
import { reactive } from 'vue'

const props = defineProps({
    chart: Object,
    axis: Object,
    activity_data: Object,
    number_activities: Object,
    months: Object




})

const chartData = reactive({
    labels: props.axis,
    datasets: [{
        label: 'Activity By Status',
        backgroundColor: '#0000FB',
        data: props.activity_data,
    }]

})

const monthData = reactive({
    labels: props.months,
    datasets: [{
        label: 'Activity Per Month',
        backgroundColor: '#f87979',
        data: props.number_activities,
    }]

})

</script>
