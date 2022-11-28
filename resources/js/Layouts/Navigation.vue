<template>
  <aside class="z-20 hidden w-40 overflow-y-auto bg-gray-400 h-screen md:block flex-shrink-0">
    <div class="py-4 text-gray-500">
      <Link class="" :href="route('dashboard')">
        <img  class=" w-full" :src="'/storage/logos/BSU.png'" />
      </Link>
      <ul class="mt-6 text-white text-bold ">
        <li class="relative px-6 py-3">
          <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
              <SvgIcon>
                <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </SvgIcon>
             </template>
            Dashboard
          </BreezeNavLink>
        </li>

        <li v-if="($page.props.auth.user.role).toLowerCase()=='student organization'" class="relative px-6 py-3">
          <BreezeNavLink :href="route('users.index')" :active="route().current('users.index')">
            <template #icon>
              <SvgIcon>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                 </SvgIcon>
            </template>
              User
          </BreezeNavLink>
        </li>

        <li v-if="($page.props.auth.user.role).toLowerCase()=='president'" class="relative px-6 py-3">
            <BreezeNavLink :href="route('organization.index')" :active="route().current('organization.index')">
                <template #icon>
                   <SvgIcon>
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                   </SvgIcon>
                  </template>
                Organization
            </BreezeNavLink>
        </li>

        <li class="relative px-6 py-3">
          <BreezeNavLink :href="route('activity.index')" :active="route().current('activity.index')">
            <template #icon>
              <SvgIcon>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </SvgIcon>

            </template>
          Activities
          </BreezeNavLink>
        </li>

        <li class="relative px-6 py-3">
            <BreezeNavLink :href="route('report.index')" :active="route().current('report.index')">
                <template #icon>
                   <SvgIcon>
                        <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1
                            1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1
                            1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1
                            1 0 01-1-1v-6z">
                        </path>
                    </SvgIcon>
                </template>
                Report
            </BreezeNavLink>
        </li>
        <li class="relative px-6 py-3">
          <BreezeNavLink :href="route('statistics')" :active="route().current('statistics')">
            <template #icon>
              <SvgIcon>
                 <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
              </SvgIcon>
            </template>
           Statistics
          </BreezeNavLink>
        </li>
        <li class="relative px-6 py-3">
          <BreezeNavLink :href="route('about')" :active="route().current('about')">
            <template #icon>
              <SvgIcon>
               <path stroke-linecap="round" stroke-linejoin="round"
                   d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0
                   00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944
                   11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016
                   18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995
                   5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0
                   003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0
                   016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25
                   0 11-4.5 0 2.25 2.25 0 014.5 0z" />
              </SvgIcon>
            </template>
            About us
          </BreezeNavLink>
        </li>

      </ul>
    </div>
  </aside>
</template>

<script setup>
    import BreezeNavLink from '@/Components/NavLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import SvgIcon from '@/Components/SvgIcon.vue';
import { ref } from 'vue'
function showLogo() {
    return "storage/logos/"
}
</script>
