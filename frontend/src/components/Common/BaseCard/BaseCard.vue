<script setup lang="ts">
import type { ThankQSizeType } from '@/themes/size';
import type { BaseCardProps } from './Type';

const props = defineProps<BaseCardProps>();

const shadow = computed(() => {
  if (!props.shadow) return '';
  const _shadow: Record<ThankQSizeType, string> = {
    'xs': 'shadow-xs',
    'sm': 'shadow-sm',
    'md': 'shadow-md',
    'lg': 'shadow-lg',
    'xl': 'shadow-xl',
  }
  return _shadow[props.shadow];
})


</script>

<template>
  <div
    class="card bg-base-200 p-4"
    :class="[shadow]"
  >
    <slot />
  </div>
</template>
