import { defineStore } from 'pinia'
import type { Guest } from '@/models/guest'

export const useGuestStore = defineStore('guest', () => {
  const guest = ref<Guest>();
  function setGuest(_guest: Guest) {
    guest.value = _guest
  }

  return { setGuest, guest }
})
