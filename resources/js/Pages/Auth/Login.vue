<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-trueGray-200 ">
    <div class="w-full max-w-md">
<!--      <logo  class="block mx-auto w-full max-w-xs fill-white" height="50"  />-->
      <logo class="block mx-auto max-w-xs fill-white" width="100" height="10" />

      <div v-if="true" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <Link v-if="user" href="/" class="text-sm text-gray-700 underline">
          Home
        </Link>
        <template v-else>
          <Link v-if="true" href="/register" class="ml-4 text-sm text-gray-700 underline">
            Register
          </Link>
        </template>
      </div>


      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Impii</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Password" type="password" />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
            <span class="text-sm">Remember Me</span>
          </label>
        </div>

        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">

          <Link v-if="true" href="/register" class="btn-indigo ">Register</Link>
          <loading-button :loading="form.processing" class="btn-impii ml-1" type="submit">Login</loading-button>

        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'
import {Link} from '@inertiajs/inertia-vue3'


export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
    Link
  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user)
    return {user}
  },
  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false,
      }),
    }
  },
  methods: {
    login() {
      this.form.post('/login')
    },
  },
}
</script>
