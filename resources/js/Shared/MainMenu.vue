<template>
  <div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/sos">
        <icon name="bell-solid" class="mr-2 w-6 h-6" :class="isUrl('sos') ? 'fill-red-600' : 'fill-white group-hover:fill-red-600'" />
        <div :class="isUrl('sos') ? 'text-red-600 text-lg font-bold' : 'text-white text-lg font-bold group-hover:text-red-600'">SOS</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
        <icon name="home-solid" class="mr-2 w-6 h-6" :class="isUrl('') ? 'fill-impii' : 'fill-white group-hover:fill-impii'" />
        <div :class="isUrl('') ? 'text-impii text-lg font-bold' : 'text-white text-lg font-bold group-hover:text-impii'">Home</div>
      </Link>
    </div>

    <div v-if="user.roles.includes('agent')"  class="mb-4">
      <Link class="group flex items-center py-3" href="/agent">
        <icon name="user-solid" class="mr-2 w-6 h-6" :class="isUrl('agent') ? 'fill-impii' : 'fill-white group-hover:fill-impii'" />
        <div :class="isUrl('agent') ? 'text-impii text-lg font-bold' : 'text-white text-lg font-bold group-hover:text-impii'">Agent</div>
      </Link>
    </div>
<!--    <div v-if="user.roles.includes('client')"  class="mb-4">
      <Link class="group flex items-center py-3" href="/client">
        <icon name="lock-solid" class="mr-2 w-6 h-6" :class="isUrl('client') ? 'fill-impii' : 'fill-white group-hover:fill-impii'" />
        <div :class="isUrl('client') ? 'text-impii text-lg font-bold ' : 'text-white text-lg font-bold  group-hover:text-impii'">Client</div>
      </Link>
    </div>-->

    <div v-if="user.roles.includes('admin')"  class="mb-4">
      <Link class="group flex items-center py-3" href="/admin">
        <icon name="shield-solid" class="mr-2 w-6 h-6" :class="isUrl('admin') ? 'fill-impii' : 'fill-white group-hover:fill-impii'" />
        <div :class="isUrl('admin') ? 'text-impii text-lg font-bold ' : 'text-white text-lg font-bold  group-hover:text-impii'">Admin</div>
      </Link>
    </div>

  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {

  setup() {
    const user = computed(() => usePage().props.value.auth.user)
    return { user }
  },
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
