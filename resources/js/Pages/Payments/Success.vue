<template>
  <div>
    <Head title="Dashboard"/>
    <h1 class="mb-8 text-3xl font-bold">Payment Success</h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">


        <div class="bg-yellow-100 w-full rounded-lg py-5 px-6 mb-4 text-base text-yellow-700 mb-3" role="alert">
          Great success your payment was successful. Navigate to your security detail for more.
        </div>

        <loading-button :loading="false" @click="goToHome" type="button" class="btn-impii ml-2 mt-2 mb-4"> GO HOME
        </loading-button>
      </div>


    </div>


  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton';

export default {
  components: {
    Head,
    LoadingButton
  },
  layout: Layout,
  methods: {
    goToHome() {
      this.$inertia.visit('/');
    },
  }
}
</script>
