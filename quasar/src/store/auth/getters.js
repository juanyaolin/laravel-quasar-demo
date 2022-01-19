export function token(state) {
  return state.token;
}

export function isLogin(state) {
  return !!state.token;
}
