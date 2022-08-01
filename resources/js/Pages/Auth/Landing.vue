<template>
  <Head title="Landing"/>
  <div class="flex items-center justify-center p-6 min-h-screen bg-trueGray-200 ">
    <div class="w-full max-w-md">
      <!--      <logo  class="block mx-auto w-full max-w-xs fill-white" height="50"  />-->
      <logo class="block mx-auto max-w-xs fill-white" width="100" height="10"/>


      <div v-if="true" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <Link v-if="user" href="/" class="text-sm text-gray-700 underline">
          Home
        </Link>

        <template v-else>
          <Link href="/login" class="text-sm text-gray-700 underline">
            Log in
          </Link>

          <Link v-if="true" href="/register" class="ml-4 text-sm text-gray-700 underline">
            Register
          </Link>
        </template>
      </div>


      <div class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Landing</h1>
          <div class="mt-6 mx-auto w-24 border-b-2"/>


        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button>Register</loading-button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import LoadingButton from '@/Shared/LoadingButton'
import {Link} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'


export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    Link

  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user)
    return {user}
  },
  data() {
    return {}
  },
  methods: {
    login() {
      this.form.post('/register')
    },
  },
}
</script>
