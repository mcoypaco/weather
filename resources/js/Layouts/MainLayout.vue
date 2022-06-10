<template>
  <div class="flex min-h-screen dark:bg-slate-800 dark:text-white px-4 py-4">
    <SideNav class="hidden xl:block" />
    <div class="container md:my-12 max-w-3xl mx-auto xl:pl-60">
      <div class="flex flex-row-reverse sm:hidden">
        <CogIcon class="w-8 h-8 mb-8 cursor-pointer" />
      </div>

      <WeatherNow />

      <WeatherToday />

      <WeatherWeek />

      <SunriseSunset />

      <UVIndexWindHumidity />
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

    }
  }
}
</script>
