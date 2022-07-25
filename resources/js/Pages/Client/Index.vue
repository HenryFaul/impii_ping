<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Client</h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

        <div class="flex flex-wrap -mb-8 -mr-6 p-8">

       <div class="text-lg">Client specific features</div>

        </div>

    </div>


  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'

export default {
  components: {
    Head,
  },
  layout: Layout,
}
</script>
