<template>
  <div>
    <Head title="Users" />
    <h1 class="mb-8 text-3xl font-bold">Vouchers</h1>

    <div class="flex items-center justify-between mb-6">


    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">

          <th class="pb-4 pt-6 px-6">Key</th>
          <th class="pb-4 pt-6 px-6">Description</th>
          <th class="pb-4 pt-6 px-6">Active</th>

        </tr>
        <tr v-for="voucher in vouchers" :key="voucher.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">

            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/emergency/${voucher.id}/edit`">
              {{voucher.voucher_key}}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/emergency/${voucher.id}/edit`" tabindex="-1">
              {{voucher.description}}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/emergency/${voucher.id}/edit`" tabindex="-1">
              <div v-if="voucher.active===1">
                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">Active</span>
              </div>
              <div v-else>

                <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full">Closed</span>


              </div>

            </Link>
          </td>

          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/emergency/${voucher.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>


        <tr v-if="vouchers.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No emergencies found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'

export default {
  components: {
    Head,
    Icon,
    Link,
  },
  layout: Layout,
  props: {
    vouchers: Array,
  },
  data() {
    return {
      form: {

      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/users', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },

    makeAdmin(_id){
      this.$inertia.put(`/users/make/admin/`+_id)
    },

    makeAgent(_id){
      this.$inertia.put(`/users/make/agent/`+_id)
    },

  },
}
</script>
