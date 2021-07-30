<template>
  <div class="relative" style="margin-left: 220px">
    <div class="fixed bg-nord-dark2 w-full shadow">
      <div class="flex justify-end px-8 py-2" style="margin-right: 220px">
        <button
          class="relative mr-6 z-10 text-nord-light2 rounded focus:outline-none hover:text-white hover:border-white border border-nord-light2"
          title="Edit"
          @click="toggleInput"
        >
          <svg
            class="w-6 h-6 fill-current"
            style="padding:3px"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z" />
          </svg>
        </button>

        <button
          class="relative z-10 text-nord-light2 rounded focus:outline-none hover:text-white hover:border-white border border-nord-light2"
          title="Delete"
          @click="deletePost"
        >
          <svg
            class="w-6 h-6 fill-current"
            style="padding:3px"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="px-8 pt-4">
      <div class="markdown pt-4" v-if="isLoaded" v-html="markdown"></div>

      <div
        @click.prevent="onBlurToggle"
        class="fixed inset-0 flex justify-center items-center"
        v-if="visible"
        style="background-color:rgba(0,0,0,0.6)"
      >
        <div class="w-1/2 relative" style="height:50%" @click.prevent.stop>
          <form class="w-full h-full" @submit.prevent="onSubmit">
            <textarea
              id="modalTextArea"
              @focus="currentlyActive = true"
              @blur="onBlurToggle"
              v-hotkey="keymap"
              class="bg-nord-dark2 text-white w-full h-full p-4 shadow"
              v-model="markInput"
              @input="handleInput"
              ref="ta"
              name="body"
            ></textarea>
          </form>

          <p class="absolute text-gray-500" style="left:4px;">Ctrl+enter to save and return to view</p>
        </div>
      </div>

      <div
        v-if="deleteThis"
        @click.prevent="deleteThis = ! deleteThis"
        class="fixed inset-0 cursor-default flex justify-center items-center"
        style="background-color:rgba(0,0,0,0.6)"
      >
        <div class="bg-nord-dark2 text-white relative mt-16 py-8 px-4 rounded" @click.prevent.stop>
          <div class="w-full h-full">
            <p>Are you sure, this post will be deleted permanently?</p>
            <div class="flex justify-evenly mt-8">
              <button
                class="w-16 py-1 bg-nord-red border border-nord-dark1 rounded-md focus:outline-none hover:text-nord-light2 shadow"
                @click="callDelete"
              >Yes</button>
              <button
                @click="deleteThis = false"
                class="w-16 py-1 bg-nord-green border border-nord-dark1 rounded-md focus:outline-none hover:text-nord-light4 shadow"
              >No</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import marked from "marked";
import hljs from "highlight.js";
import "highlight.js/styles/atom-one-dark.css";

marked.setOptions({
  renderer: new marked.Renderer(),
  highlight: function(code, language) {
    const validLanguage = hljs.getLanguage(language) ? language : "plaintext";
    return hljs.highlight(validLanguage, code).value;
  },
  pedantic: false,
  gfm: true,
  breaks: true,
  sanitize: false,
  smartLists: true,
  smartypants: false,
  xhtml: false
});

export default {
  name: "Display",

  data() {
    return {
      id: "",
      markInput: "",
      visible: false,
      forRender: "",
      currentInputStart: "",
      currentlyActive: false,
      isLoaded: false,
      deleteThis: false
    };
  },

  methods: {
    callDelete() {
      axios.delete(`/api/section/${this.id}/destroy`).then(response => {
        if ((response.data = "Successfully deleted")) {
          this.deleteThis = false;
          Event.$emit("deleted");
        } else {
          alert("Sorry, cannot delete at this time");
        }
      });
    },
    deletePost() {
      this.deleteThis = !this.deleteThis;
    },

    toggleInput() {
      this.visible = !this.visible;
    },

    handleInput(e) {
      this.currentInputStart = e.target.selectionStart;
      this.currentInputEnd = e.target.selectionEnd;
    },

    bold(event) {
      if (this.currentlyActive) {
        let input = this.$refs.ta;
        let value = input.value;
        let start = input.selectionStart;
        let end = input.selectionEnd;

        if (start != end) {
          let selected = input.value.slice(start, end);
          input.setRangeText(`**${selected}**`);
        } else {
          input.value = value.slice(0, start) + "****" + value.slice(end);
          console.log(input.selectionStart);
          input.selectionStart = input.selectionEnd = start + 2;
        }
      }
      event.preventDefault();
    },

    italic(event) {
      if (this.currentlyActive) {
        let input = this.$refs.ta;
        let value = input.value;
        let start = input.selectionStart;
        let end = input.selectionEnd;

        if (start != end) {
          let selected = input.value.slice(start, end);
          input.setRangeText(`*${selected}*`);
        } else {
          input.value = value.slice(0, start) + "**" + value.slice(end);
          input.selectionStart = input.selectionEnd = start + 1;
        }
      }
      event.preventDefault();
    },

    codeBLock(event) {
      if (this.currentlyActive) {
        let input = this.$refs.ta;
        let value = input.value;
        let start = input.selectionStart;
        let end = input.selectionEnd;

        input.value = value.slice(0, start) + "```lan\n```" + value.slice(end);
        input.selectionStart = start + 3;
        input.selectionEnd = start + 6;

        // input.selectionEnd -= 4;
      }
      event.preventDefault();
    },

    onBlurToggle() {
      this.currentlyActive = false;
      this.visible = false;
    },

    onSubmit() {
      if (this.currentlyActive) {
        axios
          .patch(`/api/section/${this.id}`, {
            body: this.markInput
          })
          .then(response => {
            console.log(response.data);
            this.onBlurToggle();
          });
      }
    },

    getData(id) {
      axios.get(`/api/section/${id}`).then(response => {
        this.id = response.data.id;
        this.markInput = response.data.body;
        this.isLoaded = true;
      });
    }
  },

  created() {
    const handleU = e => {
      if (e.altKey && e.key === "u") {
        e.preventDefault();
        this.visible = true;
      }
    };

    document.addEventListener("keydown", handleU);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleU);
    });

    const handleEscape = e => {
      if (e.key === "Esc" || e.key === "Escape") {
        this.visible = false;
      }
    };

    document.addEventListener("keydown", handleEscape);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleEscape);
    });
  },

  computed: {
    markdown() {
      return marked(this.markInput);
    },

    keymap() {
      return {
        "ctrl+b": this.bold,
        "ctrl+i": this.italic,
        "ctrl+`": this.codeBLock,
        "ctrl+enter": this.onSubmit
      };
    }
  },

  watch: {
    $route(to, from) {
      this.getData(to.params.id);
    }
  },

  mounted() {
    this.getData(this.$route.params.id);
  }
};
</script>

<style scoped>
</style>
