<script setup lang="ts">
import type { BaseCenterProps } from './Type';
import BaseStack from '../BaseStack/BaseStack.vue';

const props = withDefaults(defineProps<BaseCenterProps>(), {
  col: true
});

const center = computed(() => {
  if (props.col) {
    return 'justify-center'
  }

  return 'items-center'
})

</script>

<template>
  <BaseStack
    :class="[center]"
    v-bind="$props"
  >
    <slot>ここにコンポーネントを挟んでください</slot>
  </BaseStack>
</template>
