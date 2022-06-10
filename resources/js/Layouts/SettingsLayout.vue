<template>
  <div class="flex flex-col min-h-screen dark:bg-slate-800 dark:text-white px-4 py-4">
    <div class="flex flex-row-reverse px-8">
      <XIcon class="w-8 h-8 cursor-pointer" />
    </div>
    <div class="container mx-auto max-w-xl">
      <AppSettings />
    </div>
  </div>
</template>
<script>
import AppSettings from '../Components/AppSettings'
import XIcon from '@heroicons/vue/solid/XIcon'

export default {
  components: { AppSettings, XIcon },
  data () {
    return {
      //
    }
  }
}
</script>
