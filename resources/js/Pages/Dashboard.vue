<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <div v-show="$props.default_password" class="z-50">
            <Modal>
                <template v-slot:title>
                    <p class="text-lg text-white">Change Password </p>
                </template>
                <template v-slot:message>
                    <p class="m-2"> Please Change your password </p>
                </template>
            </Modal>
        </div>
       <div v-show="$page.props.flash.pageError" class="z-40">
           <Modal>
                <template v-slot:title>
                    <p class="text-lg text-red-800">Error</p>
                </template>
                <template v-slot:message>
                    <p class="m-2">{{ $page.props.flash.pageError }}</p>
                </template>
            </Modal>
        </div>
        <div v-show="$page.props.flash.success" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <Modal>
                <template v-slot:title>
                    <p class="text-lg text-white">Success</p>
                </template>
                <template v-slot:message>
                    <p class="m-2">{{ $page.props.flash.success }}</p>
                </template>
            </Modal>
        </div>

    <div class="flex justify-center">
        <div class="block rounded-lg shadow-lg bg-white w-3/4 text-center">
            <div class="py-3 px-6 font-bold text-2xl border-b border-gray-300">
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
    import Modal from '@/Components/Modal.vue'

    import 'tw-elements';

 defineProps(['default_password'])
</script>,
