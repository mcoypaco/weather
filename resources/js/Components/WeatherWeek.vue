<template>
  <div class="px-8 py-8 mb-3 dark:bg-slate-500 border-slate-500 border-2 rounded-3xl shadow-lg">
    <div class="flex flex-row mb-6">
      <p class="grow">
        Yesterday
      </p>
      <p>33° 26°</p>
    </div>
    <div
      v-for="(day, key) in week"
      :key="key"
      class="flex flex-row justify-between items-center mb-6"
    >
      <p class="flex-auto w-12">
        {{ day }}
      </p>
      <div class="flex-auto flex flex-row justify-between items-center">
        <div class="flex flex-row items-center font-light text-sm">
          <i class="wi wi-raindrop mr-1" />
          <span>6%</span>
        </div>
        <i class="wi wi-day-sunny text-lg" />
        <i class="wi wi-day-sunny text-lg" />
        <div>
          33° 26°
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      week: [
        'Today',
        'Friday',
        'Saturday',
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday'
      ]
    }
  }
}
</script>
