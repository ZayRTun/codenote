<template>
  <div class="relative">
    <button
      class="relative z-10 block text-nord-light2 focus:outline-none"
      @click.prevent="isActive = ! isActive"
    >
      <slot name="username"></slot>
    </button>

    <button
      v-if="isActive"
      @click.prevent="isActive=false"
      tabindex="-1"
      class="fixed inset-0 w-full h-full bg-black opacity-50 cursor-default"
    ></button>

    <div
      v-if="isActive"
      class="bg-white rounded-md w-48 absolute right-0 mt-2 overflow-hidden shadow-lg"
    >
      <slot name="links"></slot>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isActive: false
    };
  },
  created() {
    const handleEscape = e => {
      if (e.key === "Esc" || e.key === "Escape") {
        this.isActive = false;
      }
    };

    document.addEventListener("keydown", handleEscape);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleEscape);
    });
  }
};
</script>

<style>
</style>
