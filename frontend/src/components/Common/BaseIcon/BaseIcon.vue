<script setup lang="ts">
import type { ThankQColorType } from '@/themes/color';
import type { BaseIconProps } from './Type';

const props = defineProps<BaseIconProps>()
const iconColor = computed(() => {
  const colorClass: Record<ThankQColorType, string> = {
    'primary': 'text-primary',
    'secondary': 'text-secondary',
    'accent': 'text-accent',
    'info': 'text-info',
    'success': 'text-success',
    'warning': 'text-warning',
    'error': 'text-error',
    'neutral': 'text-neutral',
    'base-100': 'text-base-100',
    'base-200': 'text-base-200',
    'base-300': 'text-base-300',
  }
  return props.color ? colorClass[props.color] : 'text-neutral'
});
</script>

<template>
  <span
    class="material-icons-outlined"
    :class="[iconColor]"
  >{{ icon }}</span>
</template>
