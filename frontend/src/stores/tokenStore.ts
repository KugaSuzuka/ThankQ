import { defineStore } from 'pinia'

export const useTokenStore = defineStore('token', () => {
  const token = ref<string>('');
  function setToken(_token: string) {
    token.value = _token
  }

  return { setToken, token }
})
