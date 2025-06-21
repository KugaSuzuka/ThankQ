<script setup lang="ts">
import type { BaseCarouselProps } from './Type';
import { useDialog } from '@/composables/useDialog';
import InstaxCard from '@/components/messages/ InstaxCard/ InstaxCard.vue';

const props = defineProps<BaseCarouselProps>();
const { open } = useDialog();

function onClickImage(index: number) {
  open('PhotosDialog', {
    imgList: props.imgList,
    currentIndex: index,
  })
}

</script>

<template>
  <div
    class="w-full rounded-lg relative gap-4 h-80 overflow-hidden;"
  >
    <button
      v-for="imgItem, index in props.imgList"
      :key="index"
      @click="onClickImage(index)"
    >
      <InstaxCard
        class="absolute photo-card"
        :src="imgItem.url"
        :style="`--i: ${index - 1};`"
      />
    </button>
  </div>
</template>
<style scoped>
.photo-card {
  bottom: 26px;
  left: 50%;
  width: 202px;
  height: 270px;
  transform:
    translateX(-50%)
    rotate(calc(var(--i) * 12deg))
    translateX(calc(var(--i) * 60px));
  transform-origin: bottom center;
  z-index: calc(10 - abs(var(--i)));
  transition: transform 0.3s ease;
}
</style>
