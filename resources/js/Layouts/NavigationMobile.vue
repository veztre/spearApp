<template>
  <transition
      enter-active-class="transition ease-in-out duration-150"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0">
    <div v-show="$page.props.showingMobileMenu" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
  </transition>
  <transition
      enter-active-class="transition ease-in-out duration-150"
      enter-from-class="opacity-0 transform -translate-x-20"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in-out duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0 transform -translate-x-20">
    <aside v-show="$page.props.showingMobileMenu" class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
       Spear Application
      </Link>
        <ul class="mt-6">
          <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
              </template>
              Dashboard
            </BreezeNavLink>
          </li>

          <li  v-if="($page.props.auth.user.role).toLowerCase()=='admin'" class="relative px-6 py-3">
            <BreezeNavLink :href="route('users.index')" :active="route().current('users.index')">
              <template #icon>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
              </template>
              Users
            </BreezeNavLink>
          </li>

        <li v-if="($page.props.auth.user.role).toLowerCase()=='president'" class="relative px-6 py-3">
            <BreezeNavLink :href="route('organization.index')" :active="route().current('organization.index')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Organization
            </BreezeNavLink>
        </li>

        <li v-if="($page.props.auth.user.role).toLowerCase()=='president'" class="relative px-6 py-3">
            <BreezeNavLink :href="route('users.officers')" :active="route().current('users.officers')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Officers
            </BreezeNavLink>
        </li>

        <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('activity.index')" :active="route().current('activity.index')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Activities
            </BreezeNavLink>
        </li>

        <li v-if="($page.props.auth.user.role).toLowerCase() !='president'" class="relative px-6 py-3">
            <BreezeNavLink :href="route('signature.index')" :active="route().current('signature.index')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Signature
            </BreezeNavLink>
        </li>

        <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('report.index')" :active="route().current('report.index')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Report
            </BreezeNavLink>
        </li>

        <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('statistics')" :active="route().current('statistics')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </template>
                Statistics
            </BreezeNavLink>
        </li>
         <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('about')" :active="route().current('about')">
              <template #icon>
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                     stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                </svg>
              </template>
              About us
            </BreezeNavLink>
          </li>


        </ul>
      </div>
    </aside>
  </transition>
</template>

<script setup>
    import BreezeNavLink from '@/Components/NavLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue'
</script>
