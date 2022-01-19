<template>
  <q-layout view="lHh Lpr lFf">
    <!-- Page Container -->
    <q-page-container>
      <q-page
        class="fullscreen bg-blue-3 text-white q-pa-md flex flex-center non-selectable"
      >
        <div style="width: 400px; height: 80%">
          <div
            style="font-size: 7vh; height: 20%"
            class="text-weight-bold q-pa-md q-my-md text-center flex flex-center"
          >
            SYSTEM
          </div>
          <router-view class="text-black shadow-6" />
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "AuthLayout",

  setup() {
    return {};
  },
});
</script>
