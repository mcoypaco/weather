<template>
  <div class="flex flex-row px-8 py-8 dark:bg-slate-500 border-slate-500 border-2 rounded-3xl shadow-lg">
    <div class="flex-auto w-24 flex flex-col items-center">
      <i class="wi wi-sunrise text-4xl mb-3" />
      <p>UV Index</p>
      <p class="text-slate-300">
        {{ uvIndex }}
      </p>
    </div>
    <div class="flex-auto w-24 flex flex-col items-center border-x-slate-500 dark:border-x-slate-100 border-x-2">
      <i class="wi wi-strong-wind text-4xl mb-3" />
      <p>Wind</p>
      <p class="text-slate-300">
        {{ wind }}
      </p>
    </div>
    <div class="flex-auto w-24 flex flex-col items-center ">
      <i class="wi wi-humidity text-4xl mb-3" />
      <p>Humidity</p>
      <p class="text-slate-300">
        {{ humidity }}
      </p>
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
    uvIndex () {
      try {
        let label

        if (this.mainStore.oneCall.current.uvi < 2) label = 'Low'

        else if (this.mainStore.oneCall.current.uvi > 2 && this.mainStore.oneCall.current.uvi <= 5) label = 'Moderate'

        else if (this.mainStore.oneCall.current.uvi > 5 && this.mainStore.oneCall.current.uvi <= 7) label = 'High'

        else if (this.mainStore.oneCall.current.uvi > 7 && this.mainStore.oneCall.current.uvi <= 10) label = 'Very High'

        else if (this.mainStore.oneCall.current.uvi > 10) label = 'Extreme'

        return label
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    wind () {
      try {
        return Math.round(this.mainStore.oneCall.current.wind_speed) + ' km/h'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    humidity () {
      try {
        return Math.round(this.mainStore.oneCall.current.humidity) + '%'
      } catch (error) {
        return null
      }
    }
  }
}
</script>
