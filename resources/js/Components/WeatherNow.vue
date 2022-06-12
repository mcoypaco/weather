<template>
  <div class="mb-12 mx-6 dark:text-white">
    <div class="flex flex-row justify-between">
      <div class="flex flex-col">
        <h1 class="text-6xl mb-4">
          {{ currentTemperature }}
        </h1>

        <div class="flex flex-row items-center">
          <h2 class="text-2xl font-light mr-1">
            {{ city }}
          </h2>
          <LocationMarkerIcon class="h-6 w-6" />
        </div>
      </div>
      <i
        class="wi text-8xl mt-2"
        :class="weatherIcon"
      />
    </div>

    <div class="mt-12">
      <p>{{ maxTemperature }} / {{ minTemperature }} Feels like {{ feelsLike }} </p>
      <p>{{ dayAndTime }}</p>
    </div>
  </div>
</template>
<script>
import { DateTime } from 'luxon'
import { mapStores } from 'pinia'
import { LocationMarkerIcon } from '@heroicons/vue/solid'

import main from '../Stores/main'

export default {
  components: { LocationMarkerIcon },
  computed: {
    ...mapStores(main),

    /**
     * Current temperature.
     *
     */
    currentTemperature () {
      try {
        return Math.round(this.mainStore.oneCall.current.temp) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    city () {
      try {
        return this.mainStore.forecast.city.name
      } catch (error) {
        return null
      }
    },

    /**
     * Max temperature of the day.
     *
     */
    maxTemperature () {
      try {
        return Math.round(this.mainStore.currentWeather.main.temp_max) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     * Min temperature of the day.
     *
     */
    minTemperature () {
      try {
        return Math.round(this.mainStore.currentWeather.main.temp_min) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     * Feels like `temperature`.
     *
     */
    feelsLike () {
      try {
        return Math.round(this.mainStore.currentWeather.main.feels_like) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    dayAndTime () {
      try {
        return DateTime.fromSeconds(this.mainStore.currentWeather.dt).toFormat('EEE, h:mm a')
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    weatherIcon () {
      try {
        return `wi-owm-${this.mainStore.currentWeather.weather[0].id}`
      } catch (error) {
        return null
      }
    }
  }
}
</script>
