<template>
  <div class="px-8 py-8 mb-3 dark:bg-slate-500 border-slate-500 border-2 rounded-3xl shadow-lg">
    <div class="flex flex-row mb-6">
      <p class="grow">
        Today
      </p>
      <p>{{ todayMaxTemperature }} {{ todayMinTemperature }}</p>
    </div>
    <div
      v-for="(item, key) in week"
      :key="key"
      class="flex flex-row justify-between items-center mb-6"
    >
      <p class="flex-auto w-12">
        {{ day(item) }}
      </p>
      <div class="flex-auto flex flex-row justify-between items-center">
        <div class="flex flex-row items-center font-light text-sm">
          <i class="wi wi-raindrop mr-1 text-blue-500" />
          <span>{{ chanceOfRain(item) }}</span>
        </div>
        <i
          class="wi text-lg text-gray-500 dark:text-gray-300"
          :class="weatherIcon(item)"
        />
        <div>
          {{ maxTemperature(item) }} {{ minTemperature(item ) }}
        </div>
      </div>
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
    todayMaxTemperature () {
      try {
        return Math.round(this.mainStore.oneCall.daily[0].temp.max) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    todayMinTemperature () {
      try {
        return Math.round(this.mainStore.oneCall.daily[0].temp.min) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    week () {
      try {
        return this.mainStore.oneCall.daily.slice(1)
      } catch (error) {
        return null
      }
    }
  },
  methods: {
    /**
     *
     *
     */
    day (item) {
      try {
        return DateTime.fromSeconds(item.dt).toFormat('EEEE')
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    chanceOfRain (item) {
      try {
        return Math.round(item.pop * 100) + '%'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    weatherIcon (item) {
      try {
        return `wi-owm-${item.weather[0].id}`
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    maxTemperature (item) {
      try {
        return Math.round(item.temp.max) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    minTemperature (item) {
      try {
        return Math.round(item.temp.min) + '°'
      } catch (error) {
        return null
      }
    }
  }
}
</script>
