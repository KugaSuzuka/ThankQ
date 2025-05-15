export function useSkeleton(isLoading: Ref | ComputedRef) {
  return computed(() => {
    if (isLoading.value) {
      return 'skeleton'
    }

    return ''
  })
}
