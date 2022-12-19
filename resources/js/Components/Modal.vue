<template>
    <div class="container">
        <div class="flex justify-center">
       <div v-show="isOpen" class="
          absolute
          inset-0
          flex

          items-center
          justify-center
          bg-gray-700 bg-opacity-50
        ">
                <div class="bg-white w-1/3 rounded-md shadow-xl">
                    <div class="p-2  bg-blue-700 flex items-center justify-between">
                        <p class="text-lg"> <slot name="title"/> </p>
                        <svg @click="isOpen = false" xmlns="http://www.w3.org/2000/svg"
                            class="ml-5 w-8 h-8 text-red-900 cursor-pointer" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mt-4">
                         <p class="m-5 items-center">
                            <slot name="message"/>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref } from 'vue'
    let isOpen = ref(true)
</script>
