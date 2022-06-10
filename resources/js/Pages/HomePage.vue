<template>
  <div>
    <!-- <ManageLocationsModal class="hidden md:block" /> -->
    <MainLayout />
    <SettingsLayout class="lg:hidden" />
    <ManageLocationsLayout class="sm:hidden" />
  </div>
</template>

<script>
import ManageLocationsModal from '../Components/ManageLocationsModal'
import MainLayout from '../Layouts/MainLayout.vue'
import ManageLocationsLayout from '../Layouts/ManageLocationsLayout.vue'
import SettingsLayout from '../Layouts/SettingsLayout.vue'

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
  }
}
</script>
