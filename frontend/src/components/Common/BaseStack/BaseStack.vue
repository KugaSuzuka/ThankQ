<script setup lang="ts">
import type { ThankQSizeType } from '@/themes/size';
import type { BaseStackProps } from './Type';

const props = withDefaults(defineProps<BaseStackProps>(), {
  col: true,
  grow: false
});

const gap = computed(() => {
  if (!props.gap) return 'gap-0';
  const _gap: Record<ThankQSizeType, string> = {
    'xs': 'gap-1',
    'sm': 'gap-2',
    'md': 'gap-3',
    'lg': 'gap-4',
    'xl': 'gap-6',
  }
  return _gap[props.gap];
})

const flexCol = computed(() => {
  if (!props.col) return ''
  return 'flex-col'
})

const flexGrow = computed(() => {
  if (props.grow) {
    return 'flex-grow-1'
  }
  return ''
})
</script>

<template>
  <component
    :is="component"
    class="flex"
    :class="[gap, flexCol, flexGrow]"
  >
    <slot />
  </component>
</template>
