<template>
  <div class="flex flex-col min-h-screen dark:bg-slate-800 dark:text-white px-4 py-4">
    <div
      class="flex flex-row-reverse"
      @click="close"
    >
      <XIcon class="w-8 h-8 cursor-pointer" />
    </div>
    <ManageLocationsForm />
  </div>
</template>
<script>
import ManageLocationsForm from '../Components/ManageLocationsForm'
import XIcon from '@heroicons/vue/solid/XIcon'
import { mapStores } from 'pinia'
import main from '../Stores/main'

export default {
  components: { ManageLocationsForm, XIcon },
  data () {
    return {
      //
    }
  },
  computed: {
    ...mapStores(main)
  },
  methods: {
    /**
     *
     *
     */
    close () {
      try {
        this.mainStore.$patch({ showLocationsForm: false })
      } catch (error) {
        console.error(error)
      }
    }
  }
}
</script>
