<template>
  <div class="flex flex-row px-8 py-8 mb-3 dark:bg-slate-500 border-slate-500 border-2 rounded-3xl shadow-lg">
    <div class="flex-auto w-36 flex flex-col items-center">
      <p>Sunrise</p>
      <p>{{ sunrise }}</p>
      <i class="wi wi-sunrise text-7xl mt-6 text-orange-300" />
    </div>
    <div class="flex-auto w-36 flex flex-col items-center">
      <p>Sunset</p>
      <p>{{ sunset }}</p>
      <i class="wi wi-sunset text-7xl mt-6 text-orange-500" />
    </div>
  </div>
</template>
<script>
import { DateTime } from 'luxon'
import { mapStores } from 'pinia'
import main from '../Stores/main'

export default {
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapStores(main),

    /**
     *
     *
     */
    sunrise () {
      try {
        return DateTime.fromSeconds(this.mainStore.currentWeather.sys.sunrise).toFormat('h:mm a')
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    sunset () {
      try {
        return DateTime.fromSeconds(this.mainStore.currentWeather.sys.sunset).toFormat('h:mm a')
      } catch (error) {
        return null
      }
    }
  }
}
</script>
