<template>
  <div class="bg-white dark:bg-slate-800 dark:text-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <p class="mb-2">
      Search
    </p>
    <div class="flex flex-row items-center mb-8">
      <input
        v-model="searchText"
        class="form-input px-4 py-2 mr-2 rounded-xl grow dark:text-black"
        placeholder="Enter city name..."
        @input="search(searchText)"
      >
      <SearchIcon class="w-8 h-8 text-gray-500" />
    </div>

    <div
      v-for="(item, index) in results"
      :key="index"
      class="flex flex-row items-center px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl cursor-pointer"
      @click="setCurrentLocation(item)"
    >
      <div class="flex flex-col">
        <div class="flex flex-row items-center">
          <LocationMarkerIcon class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-300" />
          <div class="font-semibold">
            {{ city(item) }}
          </div>
        </div>
        <div class="text-sm">
          {{ state(item) }} {{ country(item) }}
        </div>
      </div>
    </div>
    <div
      v-if="hasLocations"
      class="my-4"
    >
      Your locations
    </div>
    <div
      v-for="(location, index) in locations"
      :key="index"
      class="flex flex-row justify-between items-center px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl"
    >
      <div
        class="flex grow flex-col"
        @click="setCurrentLocation(location)"
      >
        <div class="flex flex-row items-center">
          <LocationMarkerIcon class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-300" />
          <div class="font-semibold">
            {{ city(location) }}
          </div>
        </div>
        <div class="text-sm">
          {{ state(location) }} {{ country(location) }}
        </div>
      </div>

      <TrashIcon
        class="w-6 h-6 cursor-pointer text-red-500"
        @click="remove(location)"
      />
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import { mapStores } from 'pinia'
import main from '../Stores/main'
import debounce from 'lodash/debounce'

import LocationMarkerIcon from '@heroicons/vue/solid/LocationMarkerIcon'
import SearchIcon from '@heroicons/vue/solid/SearchIcon'
import TrashIcon from '@heroicons/vue/solid/TrashIcon'

export default {
  components: {
    LocationMarkerIcon,
    SearchIcon,
    TrashIcon
  },
  data () {
    return {
      searchText: null,
      results: []
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
    hasLocations () {
      try {
        return this.mainStore.locations.length
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
    city (location) {
      try {
        return location.name
      } catch (error) {
        console.error(error)

        return null
      }
    },

    /**
     *
     *
     */
    state (location) {
      try {
        return location.state
          ? location.state + ','
          : null
      } catch (error) {
        console.error(error)

        return null
      }
    },

    /**
     *
     *
     */
    country (location) {
      try {
        const region = new Intl.DisplayNames(['en'], { type: 'region' })

        return region.of(location.country)
      } catch (error) {
        console.error(error)

        return null
      }
    },

    /**
     *
     *
     */
    remove (location) {
      try {
        const locations = this.mainStore.locations.slice()

        const index = locations.indexOf(location)

        locations.splice(index, 1)

        this.mainStore.$patch({ locations })

        // Store to localstorage.
        localStorage.setItem('locations', JSON.stringify(locations))
      } catch (error) {
        console.error(error)
      }
    },

    /**
     *
     *
     */
    search: debounce(async function (keyword) {
      this.results = await this.searchCity(keyword)
    }, 500),

    /**
     *
     *
     */
    searchCity (city) {
      return axios.get('/api/geo/direct', {
        params: {
          city,
          limit: 5
        }
      }).then(({ data }) => data)
        .catch(({ response }) => {
          console.error(response)
          this.results = []
        })
    },

    /**
     *
     *
     */
    setCurrentLocation (location) {
      try {
        const locations = this.mainStore.locations.slice()

        const exists = locations.filter(item => {
          return item.name === location.name
        })

        if (!exists.length) locations.push(location)

        // Store to localstorage.
        localStorage.setItem('locations', JSON.stringify(locations))

        this.mainStore.$patch({
          currentLocation: location,
          locations,
          showLocationsForm: false
        })
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
