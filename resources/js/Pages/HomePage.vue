<template>
  <div>
    <ManageLocationsModal
      v-if="showLocationsForm"
      class="hidden xl:block"
    />
    <MainLayout v-if="!showLocationsForm && !showSettings" />
    <SettingsLayout
      v-if="showSettings"
      class="xl:hidden"
    />
    <ManageLocationsLayout
      v-if="showLocationsForm"
      class="xl:hidden"
    />
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
    ...mapStores(main),

    /**
     *
     *
     */
    showLocationsForm () {
      try {
        return this.mainStore.showLocationsForm
      } catch (error) {
        return false
      }
    },

    /**
     *
     *
     */
    showSettings () {
      try {
        return this.mainStore.showSettings
      } catch (error) {
        return false
      }
    },

    /**
     *
     *
     */
    currentLocation () {
      try {
        return this.mainStore.currentLocation
      } catch (error) {
        return null
      }
    },

    /**
     *
     *
     */
    units () {
      try {
        return this.mainStore.units
      } catch (error) {
        return null
      }
    }
  },
  watch: {
    /**
     *
     *
     */
    currentLocation () {
      try {
        this.getWeatherForecast(this.mainStore.currentLocation.lat, this.mainStore.currentLocation.lon, this.mainStore.units)
      } catch (error) {
        console.error(error)
      }
    },

    /**
     *
     *
     */
    units () {
      try {
        this.getWeatherForecast(this.mainStore.currentLocation.lat, this.mainStore.currentLocation.lon, this.mainStore.units)
      } catch (error) {
        console.error(error)
      }
    }
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
        this.storeLocation(location)
      }
    }, () => {
      let locations

      try {
        locations = JSON.parse(localStorage.getItem('locations'))
      } catch (error) {
        locations = []
      }

      this.mainStore.$patch({
        locations,
        showLocationsForm: true
      })
    })
  },
  methods: {
    /**
     *
     *
     */
    storeLocation (location) {
      let locations

      try {
        locations = JSON.parse(localStorage.getItem('locations'))
      } catch (error) {
        locations = []
      }

      const exists = locations.filter(item => {
        return item.name === location[0].name
      })

      if (!exists.length) locations.push(location[0])

      // Store to localstorage.
      localStorage.setItem('locations', JSON.stringify(locations))

      // Update the store.
      this.mainStore.$patch({
        currentLocation: location[0],
        locations
      })
    },

    /**
     *
     * @param string lat
     * @param string lon
     * @param units lon
     */
    async getWeatherForecast (lat, lon, units) {
      this.mainStore.$patch({ loading: true })

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
        oneCall: responses[2],
        loading: false
      })
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
