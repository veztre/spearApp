<template>
    <header class="z-10 py-4 bg-red-700 shadow-md">
      <div class="container flex justify-between items-center px-6 mx-auto h-full text-purple-600 md:justify-end">
        <!-- Mobile hamburger -->
        <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu" class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" aria-label="Menu">
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          </svg>
        </button>
    <h3 class="text-lg mx-10 px-10 font-large leading-6 text-white "><i class="fa-solid fa-cart-shopping"></i> SPEAR: Student Organization's Portal for Event Approval and
    Registry </h3>


        <BreezeDropdown>

          <template #trigger>
            <button class="align-middle rounded-full text-white focus:shadow-outline-purple focus:outline-none" aria-label="Account" aria-haspopup="true">
            <i class="fa-solid fa-cart-shopping"></i>  {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
            </button>
          </template>

          <template #content>
            <DropdownLink :href="route('profile.show')">
              <template #icon>
                <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                My profile
              </template>
            </DropdownLink>
                <DropdownLink :href="route('users.officers')" :active="route().current('users.officers')" v-if="($page.props.auth.user.role).toLowerCase()=='president'">
                    <template #icon>
                        <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path  d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94
                                      3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112
                                      21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12
                                      0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995
                                      5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986
                                      0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3
                                      3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5
                                      0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </template>
                    Officers
                </DropdownLink>
           <DropdownLink :href="route('signature.index')" v-if="($page.props.auth.user.role).toLowerCase() !='president'" >
                     <template #icon>
                        <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </template>
                    Signature
            </DropdownLink>
            <DropdownLink :href="route('logout')" method="post" as="button">
              <template #icon>
                <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Log Out
              </template>
            </DropdownLink>
          </template>
        </BreezeDropdown>

      </div>
    </header>
</template>

<script setup>
import BreezeDropdown from '@/Components/Dropdown.vue'
//import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import DropdownLink from "../Components/DropdownLink.vue";

</script>
