<template>
  <div>
    <Head title="Dashboard"/>
    <h1 class="mb-8 text-3xl font-bold">Agent dashboard</h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">


        <div class="text-lg mb-2 w-full">Your agent dashboard</div>
        <div class="flex space-x-2 mt-2 mb-2 justify-center">

          <div>

            <button type="button" class="inline-block ml-2 mt-1  px-6 py-2 border-2 border-green-500 text-green-500 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
              <Link  :href="`/agent/${user.id}/edit`">Agent Details</Link>
            </button>

            <button type="button" class="inline-block ml-2 mt-1    px-6 py-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
              <Link  :href="`/users/${user.id}/edit`">My Profile</Link>
            </button>
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
  },
  props: {

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
