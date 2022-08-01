<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Security detail</h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">


        <div class="mt-4 w-full mt-3 mb-1">

          <div class="text-xl mb-2 font-bold">Status:
            <span class="inline-block py-1.5 mt-2 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded">{{this.detail_status}}</span>
          </div>
          <div class="max-w-3xl w-full bg-white rounded-md shadow overflow-hidden mt-4 mr-2 mb-4 p-4">


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
                <td class="p-2">Assigned agent:</td>
                <td class="p-2">
                  <div v-if="detail.agent_accepted">

                    <Link class="group flex items-center py-3" :href="`/agent/${detail.id}/profile`" >
                      <icon name="shield-solid" class="mr-2 w-6 h-6" />
                      <div >
                        <span class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">View agent</span>

                      </div>
                    </Link>
                  </div>
                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>
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
                <td class="p-2">Actual end:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">
                    {{detail.actual_end_date}}
                  </div>
                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>

                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Total hours:</td>
                <td class="p-2">

                  <div v-if="detail.detail_ended">
                    {{detail.calc_total_hours}}
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
                    {{detail.calc_total_charge}}
                  </div>

                  <span v-else class="text-xs inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-impii text-white rounded-full">pending</span>


                </td>
              </tr>
              <tr class="row">
                <td class="p-2">Add tip:</td>
                <td class="p-2">

                  R {{detail.charge_tip}}

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

            <div v-if="detail.detail_ended && detail.final_charge>0">
              <div class="bg-yellow-100 mt-2 mb-2 rounded-lg py-5 px-6 mb-4 text-base text-yellow-700 mb-3" role="alert">
                You need to pay the final amount due.
              </div>

              <form id="payfast-pay-form" ref="payfast_pay_form" action="https://www.payfast.co.za/eng/process" method="post">

                <text-input v-model="pay_form.merchant_id" name="merchant_id" type="hidden"/>
                <text-input v-model="pay_form.merchant_key" name="merchant_key" type="hidden"/>
                <text-input v-model="pay_form.return_url" name="return_url" type="hidden"/>
                <text-input v-model="pay_form.cancel_url" name="cancel_url" type="hidden"/>
                <text-input v-model="pay_form.notify_url" name="notify_url" type="hidden"/>
                <text-input v-model="pay_form.name_first" name="name_first" type="hidden"/>
                <text-input v-model="pay_form.name_last" name="name_last" type="hidden"/>
                <text-input v-model="pay_form.email_address" name="email_address" type="hidden"/>
                <text-input v-model="pay_form.m_payment_id" name="m_payment_id" type="hidden"/>
                <text-input v-model="pay_form.amount" name="amount" type="hidden"/>
                <text-input v-model="pay_form.item_name" name="item_name" type="hidden"/>
                <text-input v-model="pay_form.item_description" name="item_description" type="hidden"/>
                <text-input v-model="pay_form.email_confirmation" name="email_confirmation" type="hidden"/>

                <loading-button  class="btn-indigo" :loading="dep_but_loading" @click="doSubmit">Pay deposit (Payfast)</loading-button>
              </form>


              <loading-button  class="btn-indigo">Pay Final (Payfast)</loading-button>


            </div>




          </div>


        </div>



      </div>

    </div>


  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import {Link} from '@inertiajs/inertia-vue3'



export default {
  components: {
    Head,
    LoadingButton,
    Link
  },
  layout: Layout,
  props: {
    detail: Object,

  },
  data() {
    return {
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


    },},

  beforeMount(){

  },
}
</script>
