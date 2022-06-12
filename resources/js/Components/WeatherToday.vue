<template>
  <div class="flex flex-row justify-between px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl shadow-lg">
    <div
      v-for="item in forecast"
      :key="item"
      class="flex flex-col text-center"
    >
      <div class="font-light mb-2">
        {{ time(item) }}
      </div>
      <i
        class="wi text-2xl mb-2"
        :class="weatherIcon(item)"
      />
      <div class="mb-4">
        {{ temp(item) }}
      </div>
      <div class="flex flex-row items-center font-light text-md">
        <i class="wi wi-raindrop mr-1" />
        <span>{{ rain(item) }}</span>
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
     * Today's Forecast
     *
     */
    forecast () {
      try {
        return this.mainStore.forecast.list.slice(0, 4)
      } catch (error) {
        return null
      }
    }
  },
  methods: {
    /**
     *
     * @param object item
     */
    time (item) {
      try {
        return DateTime.fromSeconds(item.dt).toFormat('h a')
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    temp (item) {
      try {
        return Math.round(item.main.temp) + '°'
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    rain (item) {
      try {
        return Math.round(item.pop * 100) + '%'
      } catch (error) {
        return null
      }
    },

    /**
     *
     * @param object item
     */
    weatherIcon (item) {
      try {
        return `wi-owm-${item.weather[0].id}`
      } catch (error) {
        return null
      }
    }
  }
}
</script>
