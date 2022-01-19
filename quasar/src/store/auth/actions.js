import { api } from "src/boot/axios";

export function login(context, form) {
  return api.get("sanctum/csrf-cookie").then(() => {
    return api.post("login", form).then((res) => {
      if (!res.data.code) {
        localStorage.setItem("token", res.data.data.token);
        context.dispatch("setToken", res.data.data.token);
      }
      return res;
    });
  });
}

export function logout(context) {
  return api.post("api/logout").then((res) => {
    if (!res.data.code) {
      context.dispatch("setToken", null);
      localStorage.removeItem("token");
    }
    return res;
  });
}

export function restore(context) {
  context.dispatch("setToken", localStorage.getItem("token"));
}

export function setToken(context, token) {
  context.commit("setToken", token);
}
