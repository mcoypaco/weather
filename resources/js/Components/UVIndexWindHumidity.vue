<template>
  <div class="flex flex-row px-8 py-8 dark:bg-slate-500 border-slate-500 border-2 rounded-3xl shadow-lg">
    <div class="flex-auto w-24 flex flex-col items-center">
      <i class="wi wi-sunrise text-4xl mb-3" />
      <p>UV Index</p>
      <p class="text-slate-300">
        Low
      </p>
    </div>
    <div class="flex-auto w-24 flex flex-col items-center border-x-slate-500 dark:border-x-slate-100 border-x-2">
      <i class="wi wi-strong-wind text-4xl mb-3" />
      <p>Wind</p>
      <p class="text-slate-300">
        3 km/h
      </p>
    </div>
    <div class="flex-auto w-24 flex flex-col items-center ">
      <i class="wi wi-humidity text-4xl mb-3" />
      <p>Humidity</p>
      <p class="text-slate-300">
        81%
      </p>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      //
    }
  }
}
</script>
