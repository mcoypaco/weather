<template>
  <div class="flex flex-row justify-between px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl shadow-lg">
    <div
      v-for="item in today"
      :key="item"
      class="flex flex-col text-center"
    >
      <div class="font-light mb-2">
        8 AM
      </div>
      <i class="wi wi-day-sunny text-2xl mb-2" />
      <div class="mb-4">
        30°
      </div>
      <div class="flex flex-row items-center font-light text-md">
        <i class="wi wi-raindrop mr-1" />
        <span>6%</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      today: [1, 2, 3, 4]
    }
  }
}
</script>
