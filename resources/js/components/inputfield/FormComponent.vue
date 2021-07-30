<template>
  <div class="p-8 pt-4" style="margin-left: 220px; margin-bottom: 400px;">
    <div class="bg-white p-4">
      <form @submit.prevent="onSubmit">
        <div class="mb-6">
          <label for="name" class="block uppercase font-bold text-sm text-gray-700 mb-2">Name</label>

          <input v-model="name" class="border rounded p-2 w-full" type="text" id="name" />
        </div>

        <div class="mb-6">
          <label for="title" class="block uppercase font-bold text-sm text-gray-700 mb-2">Title</label>

          <input v-model="title" class="border rounded p-2 w-full" type="text" id="title" />
        </div>

        <div class="mb-6">
          <label for="body" class="block uppercase font-bold text-sm text-gray-700 mb-2">Body</label>

          <input v-model="body" class="border rounded p-2 w-full" type="text" id="body" />
        </div>

        <div class="mb-6">
          <button
            type="submit"
            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
          >Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      title: "",
      body: ""
    };
  },

  methods: {
    onSubmit() {
      axios.post("/api/section", this.$data);
    }
  }
};
</script>

<style>
</style>
