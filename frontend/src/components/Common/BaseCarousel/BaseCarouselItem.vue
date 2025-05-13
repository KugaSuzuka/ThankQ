<script setup lang="ts">
import { useSkeleton } from '@/composables/useSkeleton';
import type { ImgItemType } from './Type';

const props = defineProps<{
  imgItem: ImgItemType,
  isLoading?: boolean,
}>();
const skeleton = useSkeleton(computed(() => {
  return props.isLoading
}))

</script>

<template>
  <div
    class="carousel-item w-full"
  >
    <div
      v-if="skeleton"
      class="w-full aspect-square"
      :class="skeleton"
    />
    <img
      v-else
      class="w-full aspect-square"
      :src="imgItem.url"
    >
  </div>
</template>
