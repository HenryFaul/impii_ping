<template>
  <div>
    <Head title="agent edit" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">

        Agent edit / {{agent_user[0].first_name}} {{agent_user[0].last_name}}
      </h1>
    </div>



    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">

      <form @submit.prevent="update">

        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input :error="form.errors.tag_line" v-model="form.tag_line" class="pb-8 pr-6 w-full lg:w-1/2" label="Tag line" />

          <select-input :error="form.errors.is_available" v-model="form.is_available"  class="pb-8 pr-6 w-full lg:w-1/2"
                        label="Availability">
            <option value="1">Available</option>
            <option value="0">Not Available</option>
          </select-input>

          <textarea-input :error="form.errors.accreditations" v-model="form.accreditations" class="pb-8 pr-6 w-full"
                          placeholder_val="Your accreditations & certifications..."
                          label="Accreditations"/>

          <textarea-input :error="form.errors.about_summary" v-model="form.about_summary" class="pb-8 pr-6 w-full"
                          placeholder_val="Your experience and skills..."
                          label="Summary"/>

        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-impii ml-auto" type="submit">Update Agent</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
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
    agent_user: Object,
  },
  remember: 'form',
  setup() {
    const user_function = computed(() => usePage().props.value.auth.user)
    return { user_function }
  },
  beforeMount(){

  },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        tag_line: this.agent_user[0].agentdetail.tag_line,
        is_available:this.agent_user[0].agentdetail.is_available,
        accreditations:this.agent_user[0].agentdetail.accreditations,
        about_summary:this.agent_user[0].agentdetail.about_summary,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/agent/${this.agent_user[0].id}/update`, {
        onSuccess: () => alert("updated"),
      })
    },

  },
}
</script>
