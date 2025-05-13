<script setup lang="ts">
import BaseCarouselItem from './BaseCarouselItem.vue';
import type { BaseCarouselProps } from './Type';
const props = defineProps<BaseCarouselProps>();

const SCROLL_INTERVAL = 5000;
const isScrolling = ref(false);
const carousel = useTemplateRef<HTMLDivElement>('carousel')
const items = useTemplateRef('carouselItems')
const { stop } = useIntersectionObserver(carousel, () => {
  autoScroll()
})

function autoScroll() {
  const imgWidth = _getImageElWidth()
  let scroll = 0;

  if (typeof imgWidth !== 'number') return;

  isScrolling.value = true;
  stop()

  setInterval(() => {
    const max = props.imgList.length * imgWidth
    if (typeof carousel.value?.scrollLeft !== 'number') return
    const nextScroll = carousel.value.scrollLeft + imgWidth

    if (nextScroll >= max) {
      scroll = 0
    } else {
      scroll = nextScroll
    }


    carousel.value.scroll({
      left: scroll,
      behavior: 'smooth'
    })
  }, SCROLL_INTERVAL)
}

function _getImageElWidth() {
  if (!items.value) return;
  const [imgWidth] = items.value.map((el) => {
    const _el = el?.$el as HTMLDivElement
    return _el.clientWidth
  })

  return imgWidth
}

autoScroll()

</script>

<template>
  <div
    ref="carousel"
    class="carousel w-full rounded-lg carousel-center relative"
  >
    <BaseCarouselItem
      v-for="imgItem, index in imgList"
      :key="index"
      ref="carouselItems"
      :img-item
      :is-loading
    />
  </div>
</template>
