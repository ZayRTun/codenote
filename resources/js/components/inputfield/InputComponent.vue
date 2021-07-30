<template>
  <div
    class="fixed top-0 bottom-0 left-0 right-0 flex justify-center items-center"
    style="background-color:rgba(0,0,0,0.8)"
    v-on:click="onBlurToggle"
  >
    <div class="w-1/2 relative" style="height:75%" @click.prevent.stop>
      <form class="w-full h-full flex flex-col" @submit="onSubmit">
        <input
          class="bg-nord-dark2 text-white w-full p-2 shadow rounded mb-6 flex-initial"
          type="text"
          list="notes"
          name="bookname"
          v-model="noteName"
          required
          placeholder="Notebook Name"
        />
        <datalist id="notes">
          <option v-for="note in listOfNotes" :key="note.name" :value="note.name">{{ note.name }}</option>
        </datalist>

        <input
          class="bg-nord-dark2 text-white w-full p-2 shadow rounded mb-6 flex-initial"
          type="text"
          name="title"
          id="title"
          v-model="markSectionTitle"
          required
          placeholder="Title"
        />

        <textarea
          id="modalTextArea"
          @focus="currentlyActive = true"
          v-hotkey="keymap"
          class="bg-nord-dark2 text-white w-full h-full p-2 shadow rounded mb-6 flex-1"
          v-model="markInput"
          @input="handleInput"
          ref="ta"
          name="body"
          autofocus
          placeholder="Markdown"
        ></textarea>
        <!-- <button class="bg-red-400 p-4" type="submit">Submit</button> -->
      </form>

      <p
        class="absolute text-gray-500 bottom-0"
        style="left:4px;"
      >Ctrl+enter to save and return to view</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["oldData"],

  data() {
    return {
      currentInputStart: "",
      currentlyActive: false,
      noteName: "",
      markSectionTitle: "",
      markInput: "",
      listOfNotes: []
    };
  },

  methods: {
    onBlurToggle() {
      this.currentlyActive = false;
      this.$emit("onBlur");
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
          input.selectionStart = input.selectionEnd = input.selectionStart - 2;
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
          input.selectionStart = input.selectionEnd = input.selectionStart - 1;
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
        input.selectionStart -= 7;
        input.selectionEnd -= 4;
      }
      event.preventDefault();
    },

    onSubmit() {
      axios
        .post("/api/section", {
          name: this.noteName,
          title: this.markSectionTitle,
          body: this.markInput
        })
        .then(response => {
          console.log(response.data);
          this.$router.push({
            name: "Display",
            params: { id: response.data.id }
          });
          this.$emit("onSuccess");
        });
    }
  },

  computed: {
    keymap() {
      return {
        "ctrl+b": this.bold,
        "ctrl+i": this.italic,
        "ctrl+`": this.codeBLock,
        "ctrl+enter": this.onSubmit
      };
    }
  },

  mounted() {
    axios
      .get("/api/notename")
      .then(response => (this.listOfNotes = response.data));
  }
};
</script>

<style>
</style>
