<template>
  <div>
    <div class="fixed h-full overflow-y-scroll" style="width: 220px">
      <div class="bg-nord-dark2 flex justify-start px-8 py-2 shadow">
        <button
          class="relative z-10 text-nord-light2 rounded focus:outline-none hover:text-white hover:border-white"
          title="Add new"
          @click="onCreateNew"
        >
          <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
              d="M2 4v14h14v-6l2-2v10H0V2h10L8 4H2zm10.3-.3l4 4L8 16H4v-4l8.3-8.3zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"
            />
          </svg>
        </button>
      </div>

      <div class="px-8 pt-8 text-white">
        <div v-if="sideMenus.length">
          <div v-for="menu in sideMenus" :key="menu.id">
            <tree-component class="my-1" v-bind:menu-section="menu"></tree-component>
          </div>
        </div>
      </div>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
import treeComponent from "../widgets/Tree.vue";

export default {
  components: {
    treeComponent
  },

  name: "SidebarComponent",

  props: ["sideMenus"],

  data() {
    return {
      navItems: []
    };
  },

  methods: {
    onCreateNew() {
      this.$emit("createNew");
    },

    onEscape() {
      this.$emit("onEscape");
    }

    // loadData() {
    //   axios
    //     .get("/api/sidemenu")
    //     .then(response => (this.navItems = response.data));
    // }
  },

  created() {
    const handleN = e => {
      if (e.altKey && e.key === "n") {
        e.preventDefault();
        this.onCreateNew();
      }
    };

    document.addEventListener("keydown", handleN);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleN);
    });

    const handleEscape = e => {
      if (e.key === "Esc" || e.key === "Escape") {
        this.onEscape();
      }
    };

    document.addEventListener("keydown", handleEscape);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleEscape);
    });

    // this.loadData();
  }
};
</script>

<style scoped>
</style>
