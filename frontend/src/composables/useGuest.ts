import { getGuest } from "@/services/getGuest";
import { useGuestStore } from "@/stores/guestStore";
const _isLoading = ref(false)

export function useGuest() {
  const { setGuest, guest } = useGuestStore()
  const _errorMessage = ref('');

  return {
    isLoading: computed(() => {
      return _isLoading.value
    }),
    reloadGuest: async (token: string) => {
      if (guest) return;
      _isLoading.value = true
      _errorMessage.value = '';

      try {
        const response = await getGuest(token);
        setGuest(response.data);
      } catch {
        _errorMessage.value =
          'メッセージを取得できませんでした。\nもう一度QRコードを読み込んでください。\nそれでもダメであれば、\n新郎・新婦へご連絡ください。。🙇🙇‍♀️';
      }
      finally {
        _isLoading.value = false;
      }
    },
    errorMessage: computed(() => {
      return _errorMessage.value
    })
  }
}
