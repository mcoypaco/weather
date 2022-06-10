<template>
  <div class="min-w-full py-8 px-8">
    <div class="flex flex-row mb-4">
      <StarIcon class="w-6 h-6 mr-2" />
      Favorites
    </div>

    <div class="flex flex-row justify-between cursor-pointer my-6">
      <div class="flex flex-row items-center ml-6">
        <LocationMarkerIcon class="w-4 h-4 mr-2" />
        <div class="font-semibold">
          Caingin
        </div>
      </div>

      <div class="flex flex-row items-center">
        <i class="wi wi-day-sunny mr-2" />
        <span>29°</span>
      </div>
    </div>

    <div class="my-4 pb-4 border-b-2 border-dashed">
      <div class="py-2 px-2 rounded-3xl dark:bg-slate-500 border-2 border-slate-500 text-center cursor-pointer">
        Manage Locations
      </div>
    </div>

    <div class="flex flex-row items-center">
      <span class="grow">Unit</span>
      <i class="wi wi-celsius text-4xl text-blue-500 mr-4 cursor-pointer" />
      <i class="wi wi-fahrenheit text-4xl cursor-pointer" />
    </div>
  </div>
</template>
<script>
import LocationMarkerIcon from '@heroicons/vue/solid/LocationMarkerIcon'
import StarIcon from '@heroicons/vue/solid/StarIcon'

export default {
  components: { LocationMarkerIcon, StarIcon },
  data () {
    return {
      //
    }
  }
}
</script>
