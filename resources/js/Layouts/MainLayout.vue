<template>
  <div class="flex min-h-screen dark:bg-slate-800 dark:text-white px-4 py-4">
    <SideNav class="hidden xl:block" />
    <div class="container md:my-12 max-w-3xl mx-auto xl:pl-60">
      <div v-if="loading">
        Loading...
      </div>
      <template v-else>
        <div class="flex flex-row-reverse xl:hidden">
          <CogIcon
            class="w-8 h-8 mb-8 cursor-pointer"
            @click="showSettings"
          />
        </div>

        <WeatherNow />

        <WeatherToday />

        <WeatherWeek />

        <SunriseSunset />

        <UVIndexWindHumidity />
      </template>
    </div>
  </div>
</template>
<script>
import CogIcon from '@heroicons/vue/solid/CogIcon'
import SideNav from '../Components/SideNav'
import SunriseSunset from '../Components/SunriseSunset'
import UVIndexWindHumidity from '../Components/UVIndexWindHumidity'
import WeatherNow from '../Components/WeatherNow'
import WeatherToday from '../Components/WeatherToday'
import WeatherWeek from '../Components/WeatherWeek'
import { mapStores } from 'pinia'
import main from '../Stores/main'

export default {
  components: {
    CogIcon,
    SideNav,
    SunriseSunset,
    UVIndexWindHumidity,
    WeatherNow,
    WeatherToday,
    WeatherWeek
  },
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
    loading () {
      try {
        return this.mainStore.loading
      } catch (error) {
        return false
      }
    }
  },
  methods: {
    /**
     *
     *
     */
    showSettings () {
      try {
        this.mainStore.$patch({ showSettings: true })
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
