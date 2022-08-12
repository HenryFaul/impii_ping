<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Admin Security detail</h1>


      <div class="flex flex-wrap -mb-8 -mr-6 p-8">


        <div class="mt-4 w-full mt-3 mb-1">

          <div class="text-xl mb-2 font-bold">Security detail status:

            <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded">{{detail.detail_status }}</span>
          </div>
          <div class="max-w-3xl w-full bg-white rounded-md shadow overflow-hidden mt-4 mr-2 mb-4 p-4">

            <form @submit.prevent="update">

            <table class="w-full table-auto border-spacing-2 mt-2 mb-2 p-2">

              <tbody class="divide-y divide-gray-300">
              <tr class="row">
                <td class="p-2">Protection type:</td>
                <td class="p-2">

                  <div v-if="detail.security_type_id ===1">
                    Personal Protection
                  </div>

                  <div v-else>
                    CPO Protection
                  </div>

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Assign agent:</td>
                <td class="p-2">

                  <select-input  v-model="form.agent_id"
                                class="pb-8 pr-6 w-full lg:w-1/2" label="Agent">
                    <option v-for="agent in agent_users" :value="agent.id" :key="agent.id" >{{agent.first_name}} - {{agent.email}}</option>

                  </select-input>

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Client :</td>
                <td class="p-2">
                  {{user.first_name}} {{user.last_name}}

                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Client email :</td>
                <td class="p-2">
                  {{user.email}}

                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Client cell :</td>
                <td class="p-2">
                  {{user.cell_no}}

                </td>
              </tr>


              <tr class="row">
                <td class="p-2">Address:</td>
                <td class="p-2">
                  {{detail.address}}
                </td>
              </tr>
              <tr class="row">
                <td class="p-2">City:</td>
                <td class="p-2">
                  {{detail.city}}

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Actual start:</td>
                <td class="p-2">
                  {{detail.start_date}}
                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Set Actual end:</td>
                <td class="p-2">
                  <label for="end_date">End Date</label>
                  <datepicker class="mt-2 mb-2" id="end_date" v-model="form.actual_end_date"></datepicker>
                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Actual end:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">{{detail.actual_end_date}}</div>
                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>



                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Detail started</td>
                <td class="p-2">

                  <select-input v-model="form.detail_started" class="pb-8 pr-6 w-full lg:w-1/2"
                                label="Detail started">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select-input>

                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Detail ended</td>
                <td class="p-2">
                  <select-input v-model="form.detail_ended" class="pb-8 pr-6 w-full lg:w-1/2"
                                label="Detail ended">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select-input>
                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Detail closed</td>
                <td class="p-2">
                  <select-input v-model="form.detail_closed" class="pb-8 pr-6 w-full lg:w-1/2"
                                label="Detail closed">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select-input>

                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Prompt payment</td>
                <td class="p-2">
                  <loading-button  class="btn-indigo">Prompt</loading-button>
                </td>
              </tr>

              <tr class="row">
                <td class="p-2">Total hours:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">
                    {{detail.calc_total_hours}} hours
                  </div>
                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Hourly rate:</td>
                <td class="p-2">
                  R {{detail.hourly_rate}} per hour

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Total cost:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">
                    R {{detail.calc_total_charge}}
                  </div>

                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Less deposit:</td>
                <td class="p-2">

                  R {{detail.deposit_received}}

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Less voucher:</td>
                <td class="p-2">

                  R {{detail.voucher_max}}

                </td>
              </tr>
              <tr class="font-bold row">
                <td class="p-2">Final cost:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">

                    <div v-if="detail.final_charge>0">
                      R {{detail.final_charge}}
                    </div>

                    <div v-else>
                      No charge applicable
                    </div>

                  </div>

                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>

                </td>
              </tr>
              </tbody>
            </table>
              <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
                <loading-button :loading="form.processing" class="btn-impii ml-auto" type="submit">Update Detail</loading-button>
              </div>

            </form>

          </div>


        </div>



      </div>

    </div>

</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Layout from '@/Shared/Layout';
import LoadingButton from '@/Shared/LoadingButton';
import SelectInput from '@/Shared/SelectInput';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'




export default {
  components: {
    Head,
    LoadingButton,
    SelectInput,
    Datepicker
  },
  layout: Layout,
  props: {
    detail: Object,
    agent_users: Array,
    user:Object

  },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        agent_id:this.detail.agent_id,
        actual_end_date:this.detail.actual_end_date,
        detail_started:this.detail.detail_started,
        detail_ended:this.detail.detail_ended,
        detail_closed:this.detail.detail_closed

      }),
      detail_status:'Pending'
    }
  },
  methods: {
    doStatus() {

      if (this.detail.detail_closed===1){

        this.detail_status='Closed';

      } else if (this.detail.detail_ended===1){

        this.detail_status='Ended';

      } else if (this.detail.detail_started===1){

        this.detail_status='Started';

      } else if (this.detail.agent_accepted===1){

        this.detail_status='Agent accepted';
      }


    },
    update() {
      this.form.post(`/admin/detail/${this.detail.id}/update`, {
        onSuccess: () => alert("updated"),
      })
    },


  },


  beforeMount(){
    console.log(this.agent_users[0])
    this.doStatus();
  },
}
</script>
