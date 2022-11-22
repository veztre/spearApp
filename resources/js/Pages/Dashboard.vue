<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>

        <template #header>
            Dashboard
        </template>
        <div v-show="$props.default_password" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-10 bg-orange-500">
                <SvgIcon>
                    <path stroke-linecap="round" stroke-linejoin="round"
                         d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948
                            3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949
                            3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12
                            15.75h.007v.008H12v-.008z" />
                </SvgIcon>
            </div>
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                <span class="font-semibold text-orange-500">Warning!!!</span>
                <p class="text-sm text-gray-600">Please Change your Password</p>
                </div>
            </div>
        </div>
       <div v-show="$page.props.flash.pageError" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-red-500">
                <SvgIcon >
                    <path stroke-linecap="round" stroke-linejoin="round"
                     d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" >
                   </path>
                </SvgIcon>
            </div>
            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-red-500">Error</span>
                    <p class="text-sm text-gray-600">{{ $page.props.flash.pageError }}</p>
                </div>
            </div>
        </div>

        <div v-show="$page.props.flash.success" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <SvgIcon>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 12.75l6 6 9-13.5" >
                    </path>
                </SvgIcon>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $page.props.flash.success }}</p>
                </div>
            </div>
        </div>


    <div class="flex justify-center">
        <div class="block rounded-lg shadow-lg bg-white w-3/4 text-center">
            <div class="py-3 px-6 border-b border-gray-300">
                System Features
            </div>
            <div class="p-6">
                <p class="text-gray-700 text-base mb-4">
                    <Carousel />
                </p>
             </div>
        </div>
    </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
    import Carousel from '@/Components/Carousel.vue'
    import SvgIcon from '@/Components/SvgIcon.vue'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import { Head } from '@inertiajs/inertia-vue3'
    import { Inertia } from "@inertiajs/inertia"

    import 'tw-elements';

 defineProps(['default_password'])
</script>,
