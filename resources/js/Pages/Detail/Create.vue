<template>
  <div>
    <Head title="Create Detail" />
    <h1 class="mb-8 text-3xl font-bold">
      New security detail
    </h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden p-2">
      <div class="w-full bg-gray-200 rounded-full mt-2 mb-2  p-2">
        <div
          class="bg-impii text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full"
          :style="{width: form_step+'%'}"
        >
          {{ form_step }}%
        </div>
      </div>


      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-3">
          <div class="w-full p2 m-2">
            <div v-if="form_step==0" id="s1">
              <h1 class="mb-8 text-lg font-bold">
                Protection Type
              </h1>

              <div>
                <select-input
                  v-model="form.protection_type" :error="form.protection_type.country"
                  class="pb-8 pr-6 w-full lg:w-1/2" label="Protection Type"
                >
                  <option value="0">Personal Protection</option>
                  <option value="1">CPO Protection</option>
                </select-input>
              </div>

              <div v-if="form.protection_type==='0'" class="p2 m-2 mb-10">
                <div class="flex justify-center">
                  <div class="block rounded-lg shadow-lg bg-coolGray-100  max-w-sm text-center">
                    <div class="py-3 px-6 border-b border-gray-300">
                      {{services[0].service_name}}
                    </div>
                    <div class="p-6">
                      <h5 class="text-gray-900 text-xl font-medium mb-2">
                        {{services[0].tag_line}}
                      </h5>
                      <p class="text-gray-700 text-base mb-4">
                        {{services[0].description}}
                      </p>
                      <div class="w-full">
                        <table class="w-full">
                          <tr>
                            <th>Features</th>
                          </tr>
                          <tr>
                            <td>Personal Bodyguard</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Designated Driver</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Combat Training</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Medical Training</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>For informal events</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>For high-risk events</td>
                            <td>
                              <icon name="cross-solid" :class="'fill-red-600'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Carries Firearm</td>
                            <td>
                              <icon name="cross-solid" :class="'fill-red-600'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Advanced CPO Training</td>
                            <td>
                              <icon name="cross-solid" :class="'fill-red-600'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                      R{{services[0].hourly_rate}} per hour.
                    </div>
                  </div>
                </div>
              </div>

              <div v-if="form.protection_type==='1'" class="p2 m-2 mb-10">
                <div class="flex justify-center">
                  <div class="block rounded-lg shadow-lg bg-coolGray-100  max-w-sm text-center">
                    <div class="py-3 px-6 border-b border-gray-300">
                      {{services[1].service_name}}
                    </div>
                    <div class="p-6">
                      <h5 class="text-gray-900 text-xl font-medium mb-2"> {{services[1].tag_line}}</h5>
                      <p class="text-gray-700 text-base mb-4">
                        {{services[1].description}}
                      </p>
                      <div class="w-full">
                        <table class="w-full">
                          <tr>
                            <th>Features</th>
                          </tr>
                          <tr>
                            <td>Personal Bodyguard</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Designated Driver</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Combat Training</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Medical Training</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>For informal events</td>
                            <td>
                              <icon name="cross-solid" :class="'fill-red-600'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>For high-risk events</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Carries Firearm</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                          <tr>
                            <td>Advanced CPO Training</td>
                            <td>
                              <icon name="tick-solid" :class="'fill-impii'" class="mr-2 w-6 h-6" />
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                      R{{services[1].hourly_rate}} per hour.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-if="form_step===20" id="s2">
              <div>
                <h1 class="mb-8 text-lg font-bold">
                  Address where the security professional will meet you
                </h1>
                <text-input
                  v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-3/4"
                  label="Address"
                />
                <div
                  v-if="form.city !='pe'"
                  class="bg-yellow-100 rounded-lg py-5 px-6 mb-4 text-base text-yellow-700 mb-3" role="alert"
                >
                  Currently only available in <b>Port Elizabeth.</b>
                </div>
                <select-input
                  v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2"
                  label="City"
                >
                  <option value="pe">Port Elizabeth</option>
                  <option value="other">*Other</option>
                </select-input>
                <textarea-input
                  v-model="form.client_briefing" class="pb-8 pr-6 w-full"
                  placeholder_val="Give us an overview of your outing or security requirement. This will help us to tailor your experience..."
                  label="Security detail instructions"
                />
              </div>
            </div>
            <div v-if="form_step===40"  id="s3" >
              <h1 class="mb-8 text-lg font-bold">Actual start date & time  </h1>
              <div class="pb-2 pr-6 w-full mt-2 lg:w-1/2 mt-1">
                <label for="start_date">Start Date</label>
                <datepicker id="start_date" v-model="form.start_date" class="mt-3 mb-3"  />
                <div class="text-xs text-info flex flex-nowrap mt-1">
                  Actual start date & time of your protection.
                  Click on clock icon to set the time.
                </div>
              </div>
            </div>
            <div v-if="form_step===60" id="s4" >
              <h1 class="mb-8 text-lg font-bold">Planned end date & time  </h1>


              <div class="pb-2 pr-6 w-full  mt-2 h-48 lg:w-1/2 mt-1">
                <label for="start_date">End Date</label>
                <datepicker id="end_date" v-model="form.end_date"  class="mt-3 mb-3" />
                <div class="text-xs flex flex-nowrap mt-1">
                  Planned end date & time of your protection (may vary).
                  Click on clock icon to set the time.
                </div>
              </div>
            </div>
            <div v-if="form_step===80" id="s5">
              <h1 class="mb-8 text-lg font-bold">
                Confirmation & notes
              </h1>

              <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden mt-2 mr-2 mb-4 p-4">
                <table class="w-full table-auto border-spacing-2 mt-2 mb-2 p-2">
                  <tr>
                    <td>Protection type:</td>
                    <td>

                      <div>
                        {{services[form.protection_type].service_name}}
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Address:</td>
                    <td>
                      {{ form.address }}
                    </td>
                  </tr>
                  <tr>
                    <td>City:</td>
                    <td>
                      {{ form.city }}
                    </td>
                  </tr>
                  <tr>
                    <td>Actual start:</td>
                    <td>
                      {{ start_nicely }}
                    </td>
                  </tr>
                  <tr>
                    <td>Planned end:</td>
                    <td>
                      {{ end_nicely }}
                    </td>
                  </tr>
                  <tr>
                    <td>Estimated hours:</td>
                    <td>
                      {{ security_hours }} hours
                    </td>
                  </tr>
                  <tr>
                    <td>Hourly rate</td>
                    <td>
                      R{{ services[form.protection_type].hourly_rate }} per hour
                    </td>
                  </tr>
                  <tr>
                    <td>Estimated total cost:</td>
                    <td>
                      R{{ estimated_total }}
                    </td>
                  </tr>
                  <tr>
                    <td>Less voucher:</td>
                    <td>
                      -R{{ voucher_value }}
                    </td>
                  </tr>
                  <tr class="font-bold">
                    <td>Total estimated cost:</td>
                    <td>
                      R{{ final_total }}
                    </td>
                  </tr>
                </table>
              </div>

              <div class="flex">
                <div class="flex-row">
                  <text-input
                    v-model="voucher_key" :error="form.errors.voucher" class="pb-8 pr-6 w-full"
                    label="Voucher"
                  />
                </div>
                <div class="flex-row">
                  <loading-button :loading="voucher_loading" type="button" class="btn-impii mt-7" @click="getVoucher">
                    Apply
                  </loading-button>
                </div>

                <div
                  v-if="show_voucher_success"
                  class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3 ml-3" role="alert"
                >
                  Voucher applied.
                </div>
                <div
                  v-if="show_voucher_error"
                  class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3 ml-3" role="alert"
                >
                  Voucher invalid.
                </div>
              </div>
            </div>
            <div v-if="form_step==100" id="s6">
              <h1 class="mb-8 text-lg font-bold">
                Deposit & Terms

                <loading-button :loading="voucher_loading" type="button" class="btn-impii mt-7" @click="doPayment">
                  Accept Terms
                </loading-button>

                <a href="https://impii.co.za/terms-conditions/" target="_blank">** Terms & Conditions</a>

                <div v-if="show_no_dep_message" class="bg-yellow-100 rounded-lg py-5 px-6 mb-4 text-base text-yellow-700 mb-3" role="alert">
                  Seems that you don't have to pay a deposit. Awesome! Accept the terms & view the detail in your dashboard.
                </div>


                <div v-if="pay_form">
                  <div v-if="show_payment_message" class="bg-yellow-100 rounded-lg py-5 px-6 mb-4 text-base text-yellow-700 mb-3" role="alert">
                    To finalise your security detail you need to pay a R100 deposit via PayFast.
                  </div>


                  <form id="payfast-pay-form" ref="payfast_pay_form" onsubmit="{alert('Redirecting to Payfast..')}" action="https://www.payfast.co.za/eng/process" method="post">
                    <text-input v-model="pay_form.merchant_id" name="merchant_id" type="hidden" />
                    <text-input v-model="pay_form.merchant_key" name="merchant_key" type="hidden" />
                    <text-input v-model="pay_form.return_url" name="return_url" type="hidden" />
                    <text-input v-model="pay_form.cancel_url" name="cancel_url" type="hidden" />
                    <text-input v-model="pay_form.notify_url" name="notify_url" type="hidden" />
                    <text-input v-model="pay_form.name_first" name="name_first" type="hidden" />
                    <text-input v-model="pay_form.name_last" name="name_last" type="hidden" />
                    <text-input v-model="pay_form.email_address" name="email_address" type="hidden" />
                    <text-input v-model="pay_form.m_payment_id" name="m_payment_id" type="hidden" />
                    <text-input v-model="pay_form.amount" name="amount" type="hidden" />
                    <text-input v-model="pay_form.item_name" name="item_name" type="hidden" />
                    <text-input v-model="pay_form.item_description" name="item_description" type="hidden" />
                    <text-input v-model="pay_form.email_confirmation" name="email_confirmation" type="hidden" />

                    <loading-button class="btn-indigo" :loading="dep_but_loading" @click="doSubmit">Pay deposit (Payfast)</loading-button>
                  </form>
                </div>
              </h1>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="false" type="button" class="btn-impii ml-2" @click="doPrev">Previous -</loading-button>
          <loading-button :loading="false" type="button" class="btn-impii ml-2" @click="doNext">Next +</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import Icon from '@/Shared/Icon'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import axios from 'axios'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import { computed, ref, defineAsyncComponent } from 'vue'


export default {


  components: {
    Head,
    LoadingButton,
    SelectInput,
    Icon,
    TextInput,
    TextareaInput,
    Datepicker,
  },

  layout: Layout,
  props: {
    services: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        email: null,
        phone: null,
        address: null,
        city: 'pe',
        client_briefing:null,
        region: null,
        protection_type: '0',
        postal_code: null,
        voucher: null,
        start_date: null,
        end_date: null,
      }),
      test_date:'2019-01-01',
      form_step: 0,
      voucher_key: '',
      db_voucher: null,
      voucher_loading: false,
      show_voucher_success: false,
      show_voucher_error: false,
      start_nicely:'',
      end_nicely:'',
      security_hours: 0,
      estimated_total: 0,
      voucher_value: 0,
      voucher_id:0,
      final_total: 0,
      pay_form:null,
      show_payment_message:false,
      show_no_dep_message:false,
      dep_but_loading:false,
      show_start:true,

    }
  },

  beforeMount(){
    const startDate = new Date()
    const endDate = new Date()

    endDate.setHours(endDate.getHours() + 2)

    this.form.start_date=startDate
    this.form.end_date=endDate



  },
  onMounted(){

  },

  methods: {
    rate(){

    },
    store() {

    },
    doNext() {

      if (this.form_step<=80){
        switch(this.form_step) {
        case 0:
          // code block
          this.form_step += 20
          break
        case 20:
          if (this.form.address == null || this.form.client_briefing == null || this.form.city !== 'pe'){
            alert('You need to complete to continue')
            break
          }
          this.form_step += 20
          break
        case 40:

          if (this.form.start_date == null || this.form.end_date == null){
            alert('You need to complete to complete both the start & end dates with times.')
            break

          }

          this.form_step += 20
          this.doSecurityTimeRate()
          break
        case 60:

          if (this.form.start_date == null || this.form.end_date == null){
            alert('You need to complete to complete both the start & end dates with times.')
            break

          }else{

            const start = new Date(this.form.start_date)
            const end = new Date(this.form.end_date)

            if (start>=end){
              alert('End date must be in the future silly')
              break
            }
          }

          this.form_step += 20
          this.doSecurityTimeRate()
          break
        case 80:
          this.form_step += 20
          break
        case 100:
          break
        default:
          // code block
        }

      }

    },
    doPrev() {

      if (this.form_step>=20){
        switch(this.form_step) {
        case 0:
          // code block
          break
        case 20:
          this.form_step -= 20
          break
        case 40:
          this.form_step -= 20
          break
        case 60:
          this.form_step -= 20
          break
        case 80:
          this.form_step -= 20
          break
        case 100:
          this.form_step -= 20
          break
        default:
          // code block
        }

      }
    },
    getVoucher() {
      this.db_voucher = null
      this.voucher_loading = true
      this.show_voucher_error = false
      this.show_voucher_success = false

      axios.get(`/voucher/${this.voucher_key}`).then(response => {
        console.log(response.data)

        if (response.data.length === 0 || response.data[0].active !== 1) {
          this.show_voucher_error = true
          this.show_voucher_success = false
        } else {
          this.db_voucher = response.data[0]
          this.show_voucher_error = false
          this.show_voucher_success = true
          this.doSecurityTimeRate()
        }

      }).catch(error => {
        // Do something
        this.show_voucher_error = true
        this.show_voucher_success = false
        console.log(error)
      }).finally(res => {
        console.log(res)
        this.voucher_loading = false
      })
    },
    doSecurityTimeRate() {

      const start = new Date(this.form.start_date)
      const end = new Date(this.form.end_date)

      this.start_nicely = start.toLocaleString()
      this.end_nicely = end.toLocaleString()

      if (this.form.start_date != null && this.form.end_date != null) {
        this.security_hours = (Math.abs(end - start) / 36e5).toFixed(2)

        //this.form.protection_type==='1'?this.security_rate=200:this.security_rate=500

        //set security type
        this.estimated_total = (this.security_hours * this.services[this.form.protection_type].hourly_rate).toFixed(2)
        this.final_total = this.estimated_total
        //check if valid voucher

        if (this.db_voucher) {
          this.voucher_value = this.db_voucher.max_amount

          if (this.voucher_value > 0) {
            //work out total
            if (this.estimated_total >= this.voucher_value) {
              this.final_total = (this.estimated_total - this.voucher_value).toFixed(2)
            }else {
              this.final_total=0
            }
          }
        }


      } else {
        this.security_hours = 0
      }

    },

    makeDetail(){
      return {
        security_type_id:this.form.protection_type,
        client_briefing:this.form.client_briefing,
        address:this.form.address,
        city:this.form.city,
        start_date:this.form.start_date,
        planned_end_date:this.form.end_date,
        hourly_rate:this.services[this.form.protection_type].hourly_rate,
        voucher_id:this.voucher_id,
        voucher_max:this.voucher_value,
      }
    },


    doPayment() {

      axios.post('/pay',this.makeDetail()).then(response => {
        console.log(response.data)

        if (response.data.result === 'val_failed'){
          alert('Validation error')
        }else{
          if (response.data.result === 'no_dep'){

            this.show_no_dep_message=true
            alert('No deposit payable')
            this.$inertia.visit('/detail/'+response.data.sec_id+'/view')

          }else{
            this.pay_form=response.data.data
            this.show_payment_message=true
          }
        }
      }).catch(error => {
        // Do something

        alert('Whoops it seems something broke. Request could not be made. Contact support.')

      }).finally(res => {
        //console.log(res);

      })
    },
    goToHome(){
      this.$inertia.visit('/')
    },
    async doSubmit(){
      await this.$refs.payfast_pay_form.$el.submit()
      this.dep_but_loading=true
    },


  },
}
</script>
