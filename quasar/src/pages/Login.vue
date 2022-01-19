<template>
  <q-card style="width: 100%">
    <q-card-section class="bg-primary text-white">
      <div class="text-h5 text-weight-bold text-center">登入</div>
    </q-card-section>

    <q-separator />

    <q-card-section>
      <q-form @submit="login" class="q-gutter-md">
        <!-- 帳號 -->
        <q-input
          outlined
          v-model="name"
          label="帳號"
          lazy-rules
          :rules="[(val) => (val && val.length > 0) || '請輸入帳號']"
        />

        <!-- 密碼 -->
        <q-input
          outlined
          v-model="password"
          label="密碼"
          :type="isPwd ? 'password' : 'text'"
          lazy-rules
          :rules="[(val) => (val && val.length > 0) || '請輸入密碼']"
        >
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>

        <!-- 記住我 -->
        <q-toggle v-model="remember" label="記住我" />

        <!-- 登入按鈕 -->
        <div class="text-center">
          <q-btn
            label="登入"
            type="submit"
            color="primary"
            style="width: 50%"
            class="text-weight-bold"
          />
        </div>
      </q-form>
    </q-card-section>

    <q-separator />

    <q-card-section>
      <div class="text-center">
        我沒有帳號，前往
        <q-btn to="/register" label="註冊" dense flat text-color="primary" />
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
import { defineComponent, ref } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default defineComponent({
  name: "Login",

  setup() {
    const name = ref("");
    const password = ref("");
    const remember = ref(false);
    const isPwd = ref(true);
    const $router = useRouter();
    const $store = useStore();

    function login() {
      var form = {
        name: name.value,
        password: password.value,
        remember: remember.value,
      };

      $store.dispatch("auth/login", form).then((res) => {
        if (res) {
          $router.push({
            path: new URL(location.href).searchParams.get("next") || "/",
          });
        }
      });
    }

    return {
      name,
      password,
      remember,
      isPwd,
      login,
    };
  },
});
</script>
