<template>
  <div class="flex flex-col min-h-screen dark:bg-slate-800 dark:text-white px-4 py-4">
    <div class="flex flex-row-reverse">
      <XIcon class="w-8 h-8 cursor-pointer" />
    </div>
    <ManageLocationsForm />
  </div>
</template>
<script>
import ManageLocationsForm from '../Components/ManageLocationsForm'
import XIcon from '@heroicons/vue/solid/XIcon'

export default {
  components: { ManageLocationsForm, XIcon },
  data () {
    return {
      //
    }
  }
}
</script>
