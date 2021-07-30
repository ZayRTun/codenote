<template>
  <div>
    <button class="flex justify-start focus:outline-none" @click="visible = !visible">
      <svg
        v-if="visible"
        class="w-6 fill-current text-nord-light2"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
      </svg>

      <svg
        v-else
        class="w-6 fill-current text-nord-light2"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
      >
        <path
          d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"
        />
      </svg>

      <p>{{ menuSection.name }}</p>
    </button>

    <div v-if="visible" class="flex pl-3">
      <div class="border-l border-nord-light4 my-2"></div>
      <div>
        <router-link
          class="ml-4 text-sm truncate block"
          v-for="sec in menuSection.sections"
          :key="sec.id"
          :to="{name: 'Display', params: {id: sec.id}}"
        >{{ sec.title }}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["menuSection"],

  data() {
    return {
      visible: false
    };
  }
};
</script>

<style>
</style>
