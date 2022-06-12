<template>
  <div
    class="relative z-10"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75" />

    <div class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
        <div class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl sm:my-8 sm:max-w-lg sm:w-full">
          <ManageLocationsForm />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ManageLocationsForm from './ManageLocationsForm'

export default {
  components: {
    ManageLocationsForm
  },
  data () {
    return {
      //
    }
  }
}
</script>
