<template>
  <div>
    <Head title="Agent Profile" />
    <h1 class="mb-8 text-3xl font-bold">Profile: {{agent_user[0].first_name}} {{agent_user[0].last_name}}</h1>

    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">

            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">
              {{agent_user[0].agentdetail.tag_line}}

            </h5>
            <div class="mt-2">
              <img v-if="photo" class="block ml-4 w-30 h-30 rounded-full" :src="photo" />

            </div>


          </div>
        </div>


        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Rating</h5>

            <div>

              <ul class="flex justify-center">

                <li>
                  <icon name="star-solid" class="mr-2 w-6 h-6"  />
                </li>

                <li>
                  <icon name="star-solid" class="mr-2 w-6 h-6"  />
                </li>
                <li>
                  <icon name="star-solid" class="mr-2 w-6 h-6"  />
                </li>
                <li>
                  <icon name="star-solid" class="mr-2 w-6 h-6"  />
                </li>
                <li>
                  <icon name="star-solid" class="mr-2 w-6 h-6"  />
                </li>
              </ul>
            </div>

          </div>
        </div>

        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Approvals</h5>

            <table class="w-full">
              <tr>
                <td>Personal Protection: </td>
                <td>

                  <icon v-if="agent_user[0].agentdetail.is_personal_protection ===1" name="tick-solid" class="mr-2 w-6 h-6"  />
                  <icon  v-else name="cross-solid" class="mr-2 w-6 h-6"  />

                </td>
              </tr>
              <tr>
                <td>CPO Protection:</td>
                <td>
                  <icon v-if="agent_user[0].agentdetail.is_cpo_protection ===1" name="tick-solid" class="mr-2 w-6 h-6"  />
                  <icon v-else name="cross-solid" class="mr-2 w-6 h-6"  />
                </td>
              </tr>

            </table>

          </div>
        </div>

        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Contact details</h5>

            <div class="mt-3 mb-2">Email: {{agent_user[0].email}}</div>
            <div class="mb-2">Cell: {{agent_user[0].cell_no}}</div>

          </div>
        </div>

        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Agency</h5>

            <div class="mt-3 mb-2">Name: {{agency.agency_name}}</div>
            <div class="mt-4 mb-2 mt-2 underline">About</div>
            <div class="mb-2"> {{agency.about_summary}}</div>
            <div class="mt-4 mb-2 mt-2 underline">Disclosures</div>
            <div class="mb-2">{{agency.disclosures}}</div>

          </div>
        </div>

        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Accreditations</h5>
            <p class="text-gray-700 text-base mb-4">
              {{agent_user[0].agentdetail.accreditations}}
            </p>
          </div>
        </div>

        <div class="flex mt-2 mb-2 w-full justify-center">
          <div class="block p-6 w-full rounded-lg shadow-lg bg max-w-sm">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">About summary</h5>
            <p class="text-gray-700 text-base mb-4">
              {{agent_user[0].agentdetail.about_summary}}
            </p>
          </div>
        </div>


      </div>

    </div>


  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'


export default {
  components: {
    Head,
    Icon
  },
  layout: Layout,
  props: {
    agent_user: Object,
    agency:Object,
    photo:null
  },
  beforeMount(){

  },
}
</script>
