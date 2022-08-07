<template>
  <div>
    <Head title="agent edit"/>
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">

        Update Emergency
      </h1>
    </div>


    <div class="max-w-3xl bg-white p-2 rounded-md shadow overflow-hidden">

      <form @submit.prevent="update">
        <table class="w-full table-auto border-spacing-2 mt-2 mb-2 p-2">

          <tbody class="divide-y divide-gray-300">

          <tr class="row">
            <td class="p-2">Name :</td>
            <td class="p-2">
              {{ emergency_user.first_name }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Surname :</td>
            <td class="p-2">
              {{ emergency_user.last_name }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Cell no :</td>
            <td class="p-2">
              {{ emergency_user.cell_no }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Email :</td>
            <td class="p-2">
              {{ emergency_user.email }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Emergency type :</td>
            <td class="p-2">
              {{ emergency.type }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Address :</td>
            <td class="p-2">
              {{ emergency.address }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Lat & Long :</td>
            <td class="p-2">
              {{ emergency.browser_lat }} {{ emergency.browser_long }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Emergency details :</td>
            <td class="p-2">
              {{ emergency.details }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Emergency date :</td>
            <td class="p-2">
              {{ emergency.created_at }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Updated date :</td>
            <td class="p-2">
              {{ emergency.updated_at }}
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Emergency status :</td>
            <td class="p-2">
              <div v-if="emergency.emergency_closed===0">
                <span
                  class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-600 text-white rounded-full">Open</span>
              </div>
              <div v-else>
                <span
                  class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded-full">Closed</span>
              </div>
            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Admin feedback:</td>
            <td class="p-2">
              <textarea-input v-model="form.admin_comments" :error="form.errors.admin_comments"
                              class="pb-8 pr-6 w-full"
                              placeholder_val="Emergency feedback..."
                              label="Emergency Feedback"/>

            </td>
          </tr>

          <tr class="row">
            <td class="p-2">Set status:</td>
            <td class="p-2">

              <select-input v-model="form.emergency_closed" class="pb-8 pr-6 w-full lg:w-1/2" label="Emergency Status">
                <option value="0">Open</option>
                <option value="1">Closed</option>
              </select-input>

            </td>
          </tr>

          </tbody>
        </table>
        <loading-button :loading="form.processing" class="btn-indigo ml-auto" @click="update">Update Emergency</loading-button>

      </form>



    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'
import TextareaInput from "@/Shared/TextareaInput";
import SelectInput from '@/Shared/SelectInput'


export default {
  components: {
    Head,
    LoadingButton,
    TextInput,
    TextareaInput,
    SelectInput
  },
  layout: Layout,
  props: {
    emergency: Object,
    emergency_user: Object
  },
  setup() {
    const user_function = computed(() => usePage().props.value.auth.user)
    return {user_function}
  },
  beforeMount() {

  },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        emergency_closed:this.emergency.emergency_closed,
        admin_comments:this.emergency.admin_comments
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/emergency/${this.emergency.id}/update`, {
      })
    },

  },
}
</script>
