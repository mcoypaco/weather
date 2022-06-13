<template>
  <div class="min-w-full py-8 px-8">
    <div class="flex flex-row mb-4">
      <StarIcon class="w-6 h-6 mr-2 text-yellow-500" />
      Favorites
    </div>

    <div
      v-for="(location, index) in locations"
      :key="index"
      class="flex flex-row justify-between cursor-pointer my-6"
      @click="setCurrentLocation(location)"
    >
      <div class="flex flex-row items-center ml-6">
        <LocationMarkerIcon class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-300" />
        <div class="font-semibold">
          {{ location.name }}
        </div>
      </div>
    </div>

    <div class="my-4 pb-4 border-b-2 border-dashed">
      <div
        class="py-2 px-2 rounded-3xl bg-blue-500 text-white text-center cursor-pointer"
        @click="showLocationsForm"
      >
        Manage Locations
      </div>
    </div>

    <div class="flex flex-row items-center">
      <span class="grow">Unit</span>
      <i
        class="wi wi-celsius text-4xl mr-4 cursor-pointer"
        :class="{'text-blue-500': isMetricUnit}"
        @click="setMetricUnits"
      />
      <i
        class="wi wi-fahrenheit text-4xl cursor-pointer"
        :class="{'text-blue-500': isImperialUnit}"
        @click="setImperialUnits"
      />
    </div>
  </div>
</template>
<script>
import LocationMarkerIcon from '@heroicons/vue/solid/LocationMarkerIcon'
import StarIcon from '@heroicons/vue/solid/StarIcon'
import { mapStores } from 'pinia'
import main from '../Stores/main'

export default {
  components: { LocationMarkerIcon, StarIcon },
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
    locations () {
      try {
        return this.mainStore.locations
      } catch (error) {
        return []
      }
    },

    /**
     *
     *
     */
    isMetricUnit () {
      try {
        return this.mainStore.units === 'metric'
      } catch (error) {
        return false
      }
    },

    /**
     *
     *
     */
    isImperialUnit () {
      try {
        return this.mainStore.units === 'imperial'
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
    setCurrentLocation (location) {
      try {
        this.mainStore.$patch({
          currentLocation: location,
          showSettings: false
        })
      } catch (error) {
        console.error(error)
      }
    },

    /**
     *
     *
     */
    showLocationsForm () {
      try {
        this.mainStore.$patch({
          showLocationsForm: true,
          showSettings: false
        })
      } catch (error) {
        console.error(error)
      }
    },

    /**
     *
     *
     */
    setMetricUnits () {
      try {
        localStorage.setItem('units', 'metric')

        this.mainStore.$patch({
          units: 'metric',
          showSettings: false
        })
      } catch (error) {
        console.error(error)
      }
    },

    /**
     *
     *
     */
    setImperialUnits () {
      try {
        localStorage.setItem('units', 'imperial')

        this.mainStore.$patch({
          units: 'imperial',
          showSettings: false
        })
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
