<template>
  <div class="relative">
    <sidebarComponent
      @createNew="onCreateNew"
      @onEscape="onEscapeEdit"
      v-bind:side-menus="sidemenu"
    ></sidebarComponent>

    <input-component @onBlur="onBlurToggle" @onSuccess="onPostSuccess" v-if="displayInputPanel"></input-component>
  </div>
</template>

<script>
import sidebarComponent from "./sidebar/SidebarComponent.vue";
import inputComponent from "./inputfield/InputComponent.vue";

export default {
  components: {
    sidebarComponent,
    inputComponent
  },

  data() {
    return {
      sidemenu: [],
      displayInputPanel: false
    };
  },

  methods: {
    onEscapeEdit() {
      this.displayInputPanel = false;
    },

    onCreateNew() {
      this.displayInputPanel = true;
    },

    onBlurToggle() {
      this.displayInputPanel = false;
    },

    onPostSuccess() {
      this.loadData();
      this.displayInputPanel = false;
    },

    loadData() {
      axios
        .get("/api/sidemenu")
        .then(response => (this.sidemenu = response.data))
        .catch(error => console.log(error));
    }
  },

  created() {
    this.loadData();

    Event.$on("deleted", () => {
      this.loadData();
      this.$router.replace({ name: "Home" });
    });
  }
};
</script>

<style>
</style>
