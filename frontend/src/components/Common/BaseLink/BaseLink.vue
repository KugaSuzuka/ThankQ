<script setup lang="ts">
import type { ThankQColorType } from '@/themes/color';
import type { BaseLinkProps } from './Type';

const props = defineProps<BaseLinkProps>();

const btnColor = computed(() => {
  const colorClass: Record<ThankQColorType, string> = {
    'primary': 'link-primary',
    'secondary': 'link-secondary',
    'accent': 'link-accent',
    'info': 'link-info',
    'success': 'link-success',
    'warning': 'link-warning',
    'error': 'link-error',
    'neutral': 'link-neutral',
    'base-100': 'link-base-100',
    'base-200': 'link-base-200',
    'base-300': 'link-base-300',
  }
  return props.color ? colorClass[props.color] : 'link-neutral'
})


</script>

<template>
  <a
    class="link"
    :class="[btnColor]"
    :href="href"
  >
    <slot />
  </a>
</template>
