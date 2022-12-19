<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <div v-show="$props.default_password" class="z-50">
            <Modal>
                <template v-slot:title>
                    <p class="text-lg text-white">Default Password </p>
                </template>
                <template v-slot:message>
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="inline-block w-6 h-6 text-orange-500">
                        <path s troke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>

                    <span class="py-1 px-1 leading-none text-center whitespace-nowrap
                                        font-bold  text-orange-500 rounded ml-2"> Please Change Your Password </span>
                </template>
            </Modal>
        </div>
       <div v-show="$page.props.flash.pageError" class="z-50">
           <Modal>
                <template v-slot:title>
                    <p class="text-lg text-red-800">Error</p>
                </template>
                <template v-slot:message>
                    <p class="m-2">{{ $page.props.flash.pageError }}</p>
                </template>
            </Modal>
        </div>
        <div v-show="$page.props.flash.success" class="z-50">
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
