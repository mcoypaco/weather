<template>
  <div class="bg-white dark:bg-slate-800 dark:text-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <p class="mb-2">
      Search
    </p>
    <div class="flex flex-row items-center mb-8">
      <input
        type="email"
        class="form-input px-4 py-2 mr-2 rounded-xl grow dark:text-black"
        placeholder="Enter city name..."
      >
      <SearchIcon class="w-8 h-8" />
    </div>

    <div class="flex flex-row items-center px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl cursor-pointer">
      <div class="flex flex-col">
        <div class="flex flex-row items-center">
          <LocationMarkerIcon class="w-4 h-4 mr-2" />
          <div class="font-semibold">
            Caingin
          </div>
        </div>
        <div class="text-sm">
          Laguna, Philippines
        </div>
      </div>
    </div>
    <div class="my-4">
      Your locations
    </div>
    <div class="flex flex-row justify-between items-center px-8 py-8 mb-3 dark:bg-slate-500 dark:text-white border-slate-500 border-2 rounded-3xl">
      <div class="flex flex-col">
        <div class="flex flex-row items-center">
          <LocationMarkerIcon class="w-4 h-4 mr-2" />
          <div class="font-semibold">
            Caingin
          </div>
        </div>
        <div class="text-sm">
          Laguna, Philippines
        </div>
      </div>

      <TrashIcon class="w-8 h-8 cursor-pointer" />
    </div>
  </div>
</template>
<script>
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
      //
    }
  }
}
</script>
