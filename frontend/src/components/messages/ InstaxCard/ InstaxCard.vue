<script setup lang="ts">
import type { InstaxCardProps } from './Type.ts';
import BaseCard from '@/components/Common/BaseCard/BaseCard.vue';
import BaseHandWrittenText from '@/components/Common/BaseHandWrittenText/BaseHandWrittenText.vue';
import BaseIcon from '@/components/Common/BaseIcon/BaseIcon.vue';

const props = withDefaults(defineProps<InstaxCardProps>(),{
  tapIcon: true
});
const tapAnimation = ref(true);

const width = computed(() => props.width ?? 202);
const height = computed(() => props.height ?? 270);


onMounted(() => {
  setTimeout(() => {
    tapAnimation.value = false;
  }, 1000);
})

</script>

<template>
  <BaseCard
    class="rounded-none bg-white pt-5 pr-5 pl-5 pb-12 photo-card shadow-md flex justify-center"
  >
    <img
      class="w-full h-full photo-card-img"
      :src
    >
    <BaseHandWrittenText
      v-if="props.tapIcon"
      class="text-xl absolute bottom-4 right-4 flex align-center"
    >
      Tap!!
      <BaseIcon
        class="tap-icon ml-1 mt-1"
        :class="{
          'tap-icon': tapAnimation,
        }"
        icon="touch_app"
      />
    </BaseHandWrittenText>
  </BaseCard>
</template>
<style scoped>
@keyframes tap-animation {
    0%   { transform: scale(1); }
    20%  { transform: scale(0.9); }
    40%  { transform: scale(1.05); }
    60%  { transform: scale(1); }
    100% { transform: scale(1); }
}

.photo-card {
  width: v-bind(width);
  height: v-bind(height);
}

.photo-card-img {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: contain;
}

.tap-icon {
  animation: tap-animation 1.2s ease-in-out infinite;
  transform-origin: center;
}
</style>
