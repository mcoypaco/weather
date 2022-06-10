<template>
  <div class="mb-12 mx-6 dark:text-white">
    <div class="flex flex-row justify-between">
      <div class="flex flex-col">
        <h1 class="text-6xl mb-4">
          29°
        </h1>

        <div class="flex flex-row items-center">
          <h2 class="text-2xl font-light mr-1">
            Caingin
          </h2>
          <LocationMarkerIcon class="h-6 w-6" />
        </div>
      </div>
      <i class="wi wi-day-sunny text-8xl mt-2" />
    </div>

    <div class="mt-12">
      <p>33° / 26° Feels like 36°</p>
      <p>Thu, 7:46 AM</p>
    </div>
  </div>
</template>
<script>
import { LocationMarkerIcon } from '@heroicons/vue/solid'

export default {
  components: { LocationMarkerIcon }
}
</script>
