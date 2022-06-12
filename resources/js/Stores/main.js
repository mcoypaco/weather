import { defineStore } from 'pinia'

export default defineStore('main', {
  state: () => {
    return {
      currentLatitude: null,
      currentLongitude: null,
      currentLocation: null,
      units: 'metric',
      currentWeather: null,
      oneCall: null,
      forecast: null,
      showLocationsForm: false,
      locations: null,
      showSettings: false,
      loading: false
    }
  }
})
