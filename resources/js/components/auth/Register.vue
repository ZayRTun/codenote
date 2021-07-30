<template>
  <div
    class="min-h-screen flex items-center justify-center bg-nord-dark2 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full bg-nord-dark4 p-8 rounded-md">
      <div>
        <img class="mx-auto h-12 w-auto" src="/images/codeicon.png" alt="Workflow" />

        <h2
          class="mt-6 text-center text-2xl leading-9 font-extrabold text-nord-light3"
        >Register for an account</h2>
      </div>

      <div>
        <slot name="regForm"></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
