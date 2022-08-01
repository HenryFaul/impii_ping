<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">S.O.S</h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">

        <div class="text-lg w-full">SOS Emergency</div>

        {{location_data}}

        <div class="w-full mt-2 mb-2 bg-white rounded-md shadow overflow-hidden">
          <form >
            <div class="flex flex-wrap w-full -mb-8 -mr-6 p-8">

              <select-input  class="pb-8 pr-6 w-full lg:w-1/2" label="Emergency Type">
                <option :value="true">Medical</option>
                <option :value="false">Crime</option>
                <option :value="false">Abduction</option>
              </select-input>

              <text-input  class="pb-8 pr-6 w-full lg:w-3/4"
                          label="Address"/>

              <textarea-input class="pb-8 pr-6 w-full"
                              placeholder_val="Give us details about your emergency.."
                              label="Emergency details"/>

            </div>
            <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
              <loading-button  class="btn-indigo" @click="posApi" type="button">Send S.O.S</loading-button>
            </div>
          </form>
        </div>


      </div>

    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import TextareaInput from "@/Shared/TextareaInput";
import axios from "axios";


export default {
  components: {
    Head,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput
  },
  layout: Layout,
  data() {
    return {
      location_data:null,
    }
  },
  methods: {
    async location() {

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function (position) {
            //do work work here
            /*
            $.post("url-here", {
                long: position.coords.longitude,
                lat: position.coords.latitude
            }).done(function (response) {
                alert(responsse)
            });
            */
          },
          function (error) {
            alert(error.message);
          }, {
            enableHighAccuracy: true
            , timeout: 5000
          }
        );
      } else {
        alert("Geolocation is not supported by this browser.");
      }

    },

    async posApi(){

      await axios.get(`/help`).then(response => {
        this.location_data=response.data
        console.log(response.data);
        alert("Got location")

      }).catch(error => {
        // Do something
        console.log(error);
      }).finally(res => {
        console.log(res);

      });

    }

  },

}
</script>
