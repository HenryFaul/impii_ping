<template>
  <div class>
    <div class="bg-black h-1"></div>
    <div class="flex">
      <div class="flex-1" v-for="s in steps" :key="s">
        <div
          v-if="step >= s"
          class="bg-blue -mt-1 h-1"
          :class="{ 'w-1/2': step == s, 'w-full': step < s }"
        >111</div>
        <div
          class="-mt-3 mx-auto rounded-full h-5 w-5"
          :class="{ 'bg-blue': s <= step, 'bg-grey-light': step != s }"
        ></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["steps", "step"]
};
</script>
