<template>
  <div style="margin-left: 220px">
    <div class="fixed bg-nord-dark2 w-full shadow" style="height: 40px">
      <div class="flex justify-end px-8 py-2"></div>
    </div>

    <div class="h-full px-8 pt-16 flex justify-center text-nord-light2">
      <div>
        <div class="text-center">
          <h1 class="text-5xl py-0">Welcome to CodeNote</h1>
          <p>Built specifically for Programmers</p>
        </div>

        <div class="flex mt-32">
          <div class="mt-4">
            <h2 class="pl-1">Keyboard Shortcuts</h2>
            <table class="table-fixed text-nord-light3">
              <tbody style="border-top: 1px solid black">
                <tr>
                  <td class="pl-1 pr-10 py-0">Alt + N</td>
                  <td class="px-6 py-0">Create new Note</td>
                </tr>
                <tr class="bg-nord-dark3">
                  <td class="pl-1 pr-10 py-0">Alt + U</td>
                  <td class="px-6 py-0">Update current note</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-4 ml-8">
            <h2 class="pl-1">Keyboard Shortcuts for Editing</h2>
            <table class="table-fixed text-nord-light3">
              <tbody style="border-top: 1px solid black">
                <tr>
                  <td class="pl-1 pr-10 py-0">Ctrl + B</td>
                  <td class="px-6 py-0">Make text Bold</td>
                </tr>
                <tr class="bg-nord-dark3">
                  <td class="pl-1 pr-10 py-0">Ctrl + I</td>
                  <td class="px-6 py-0">Make text Italic</td>
                </tr>
                <tr>
                  <td class="pl-1 pr-10 py-0">Ctrl + `</td>
                  <td class="px-6 py-0">Insert Code Block</td>
                </tr>
                <tr class="bg-nord-dark3">
                  <td class="pl-1 pr-10 py-0">Ctrl + Enter</td>
                  <td class="px-6 py-0">To Save</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home"
};
</script>

<style>
</style>
