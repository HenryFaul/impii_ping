<template>
  <Head title="Register" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-trueGray-200 ">
    <div class="w-full max-w-md">
<!--      <logo  class="block mx-auto w-full max-w-xs fill-white" height="50"  />-->
      <logo class="block mx-auto max-w-xs fill-white" width="100" height="10" />
      <div v-if="true" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        <Link v-if="user" href="/" class="text-sm text-gray-700 underline">
          Home
        </Link>

        <template v-else>
          <Link href="/login" class="text-sm text-gray-700 underline">
            Log in
          </Link>
        </template>
      </div>

      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="reCap">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Register</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />


          <text-input v-model="form.first_name" :error="form.errors.first_name"  class="mt-6" label="First name" />
          <text-input v-model="form.last_name" :error="form.errors.last_name" class="mt-6" label="Last name" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-6" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.cell_no" :error="form.errors.cell_no" class="mt-6" label="Cell" type="tel" />
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Password" type="password" />

          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.terms" class="mr-1" type="checkbox" />
            <span class="text-sm underline">
                  <a href="https://impii.co.za/terms-conditions/" target="_blank">Terms & Conditions</a>
            </span>

          </label>
        </div>

        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">

          <Link v-if="true" href="/login" class="btn-indigo ">Login</Link>
          <loading-button :loading="form.processing" class="btn-impii ml-auto" type="submit">Register</loading-button>

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
import { useReCaptcha } from 'vue-recaptcha-v3';



export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
    Link,
  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user)
    const { executeRecaptcha, recaptchaLoaded } = useReCaptcha()
    return {user,executeRecaptcha,recaptchaLoaded}
  },

  data() {
    return {
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        email: '',
        cell_no: '',
        password: '',
        photo: null,
        terms: false,
        captcha_token :null,
      }),
    }
  },
  methods: {
    register() {
      this.form.post('/register')
    },

    async reCap(){

      await this.recaptchaLoaded()
      this.form.captcha_token = await this.executeRecaptcha('login')
      this.register()



    },


  },
}
</script>
