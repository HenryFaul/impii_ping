<template>
  <div>
    <Head title="Dashboard"/>
    <h1 class="mb-8 text-3xl font-bold">SOS</h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">

        <div class="text-lg w-full">SOS Emergency</div>

        <div class="w-full mt-2 mb-2 bg-white rounded-md shadow overflow-hidden">
          <form>
            <div class="flex flex-wrap w-full -mb-8 -mr-6 p-8">

              <select-input v-model="form.type" :error="form.errors.type" class="pb-8 pr-6 w-full lg:w-1/2" label="Emergency Type">
                <option value="medical">Medical</option>
                <option value="crime">Crime</option>
                <option value="abduction">Abduction</option>
              </select-input>

              <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-3/4"
                          label="Address"/>

              <textarea-input v-model="form.emergency_details" :error="form.errors.emergency_details" class="pb-8 pr-6 w-full"
                              placeholder_val="Give us details about your emergency..."
                              label="Emergency details"/>

            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button :loading="form.processing" class="btn-emergency" @click="location" type="button">Send SOS
              </loading-button>
            </div>
          </form>
        </div>


      </div>

    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import TextareaInput from "@/Shared/TextareaInput";


export default {
  components: {
    Head,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput
  },
  layout: Layout,
  remember: 'form',
  data() {

    return {
      form: this.$inertia.form({
        _method: 'post',
        type: 'medical',
        address: '',
        emergency_details: '',
        browser_lat: '0',
        browser_long: '0'
      }),
    }
  },
  methods: {

    async location() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          position => {
            this.form.browser_lat=position.coords.latitude;
            this.form.browser_long=position.coords.longitude;
            this.post();
          },
          error => {
            this.post();

          },
        );

      } else {
        alert('Geolocation is not supported by this browser.');
      }

    },

    post() {
      this.form.post('/help', {
      })
    },

  },

}
</script>
