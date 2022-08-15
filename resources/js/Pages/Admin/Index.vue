<template>
  <div>
    <Head title="Admin"/>
    <h1 class="mb-8 text-3xl font-bold">Admin</h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">


        <div class="text-lg mb-2 w-full">Admin dashboard</div>
        <div class="flex space-x-2 justify-center w-full">
          <div class="w-full">

            <button type="button"
                    class="inline-block ml-2 mt-1  px-6 py-2 border-2 border-green-500 text-green-500 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
              <Link href="/users">User Management</Link>
            </button>

            <button type="button"
                    class="inline-block ml-2 mt-1    px-6 py-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
              <Link :href="`/users/${user.id}/edit`">Voucher Management</Link>
            </button>
            <button type="button"
                    class="inline-block ml-2 mt-1 px-6 py-2 border-2 border-red-600 text-red-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
              <Link href="/emergencies">SOS Management</Link>
            </button>
          </div>
        </div>

        <div class="mt-2 mb-2">
          <div class="text-lg mb-2">Security History</div>
          <div class="flex justify-center w-full">
            <ul class="bg-white rounded-lg border border-gray-200 w-full text-gray-900">

              <li class="px-6 py-2 border-b border-gray-200 w-full" v-for="detail in security_details" :key="detail.id">


                <Link class="group flex items-center py-3" :href="`admin/detail/${detail.id}/view`">
                  <icon name="shield-solid" class="mr-2 w-6 h-6"/>
                  <div class="underline"> {{ detail.id }}) [{{ detail.city }}] {{ detail.start_date }}

                    <span v-if="detail.detail_status==='Pending'" class="bg-impii text-xs m-2 inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold  text-white rounded-full">{{detail.detail_status }}</span>
                    <span v-if="detail.detail_status==='Accepted'" class="bg-blue-500 text-xs m-2 inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold  text-white rounded-full">{{detail.detail_status }}</span>
                    <span v-if="detail.detail_status==='Started'" class="bg-yellow-300  text-xs m-2 inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold  text-white rounded-full ">{{detail.detail_status }}</span>
                    <span v-if="detail.detail_status==='Ended'" class="bg-indigo-600 text-xs m-2 inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold  text-white rounded-full">{{detail.detail_status }}</span>
                    <span v-if="detail.detail_status==='Closed'" class="bg-green-500 text-xs m-2 inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold  text-white rounded-full">{{detail.detail_status }}</span>

                  </div>
                </Link>

              </li>
            </ul>
          </div>
        </div>


      </div>

    </div>
  </div>
</template>

<script>
import {Head, usePage} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import {Link} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'
import Icon from '@/Shared/Icon'



export default {
  setup() {
    const user = computed(() => usePage().props.value.auth.user)
    return {user}
  },
  components: {
    Head,
    Link,
    Icon
  },
  props: {

    security_details: Array,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
  layout: Layout,
}
</script>
