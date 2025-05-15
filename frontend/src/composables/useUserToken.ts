export function useUserToken() {
  const route = useRoute();

  return () => {
    return route.params.token as string;
  }
}
