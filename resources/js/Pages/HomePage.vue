<template>
  <div>
    <!-- <ManageLocationsModal class="hidden md:block" /> -->
    <MainLayout />
    <SettingsLayout class="lg:hidden" />
    <ManageLocationsLayout class="sm:hidden" />
  </div>
</template>

<script>
import axios from 'axios'
import { mapStores } from 'pinia'

import ManageLocationsModal from '../Components/ManageLocationsModal'
import MainLayout from '../Layouts/MainLayout.vue'
import ManageLocationsLayout from '../Layouts/ManageLocationsLayout.vue'
import SettingsLayout from '../Layouts/SettingsLayout.vue'
import main from '../Stores/main'

export default {
  components: {
    ManageLocationsModal,
    MainLayout,
    SettingsLayout,
    ManageLocationsLayout
  },
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapStores(main)
  },
  created () {
    navigator.geolocation.getCurrentPosition(async (position) => {
      // Sets current latitude and longitude to pinia.
      this.mainStore.$patch({
        currentLatitude: position.coords.latitude,
        currentLongitude: position.coords.longitude
      })

      // Get the city from the latitude and longitude.
      const location = await axios.get('/api/geo/reverse', {
        params: {
          lat: position.coords.latitude,
          lon: position.coords.longitude
        }
      }).then(({ data }) => data)

      // Store the current location.
      if (location) {
        this.mainStore.$patch({ currentLocation: location })

        this.getWeatherForecast(this.mainStore.currentLatitude, this.mainStore.currentLongitude, this.mainStore.units)
      }
    })
  },
  methods: {
    /**
     *
     * @param string lat
     * @param string lon
     * @param units lon
     */
    async getWeatherForecast (lat, lon, units) {
      const responses = await Promise.all([
        this.currentWeather(lat, lon, units),
        this.forecast(lat, lon, units),
        this.oneCall(lat, lon, units)
      ]).catch(() => {
        alert('Something went wrong!')
      })

      this.mainStore.$patch({
        currentWeather: responses[0],
        forecast: responses[1],
        oneCall: responses[2]
      })

      console.log({ responses })
    },

    /**
     *
     *
     */
    oneCall (lat, lon, units) {
      return axios.get('api/weather-forecast/onecall', {
        params: {
          lat,
          lon,
          exclude: 'alerts',
          units
        }
      }).then(({ data }) => data)
    },

    /**
     *
     *
     */
    currentWeather (lat, lon, units) {
      return axios.get('api/weather-forecast/weather', {
        params: {
          lat,
          lon,
          units
        }
      }).then(({ data }) => data)
    },

    /**
     *
     *
     */
    forecast (lat, lon, units) {
      return axios.get('api/weather-forecast/forecast', {
        params: {
          lat,
          lon,
          units
        }
      }).then(({ data }) => data)
    }
  }
}
</script>
