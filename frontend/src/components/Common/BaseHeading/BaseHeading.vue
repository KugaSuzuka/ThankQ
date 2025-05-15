<script setup lang="ts">
import type { BaseHeadingProps } from './Type';
defineProps<BaseHeadingProps>();

</script>

<template>
  <h1
    v-if="tag === 'h1'"
    class="text-3xl font-semibold"
  >
    <slot />
  </h1>

  <h2
    v-else-if="tag === 'h2'"
    class="text-2xl font-semibold"
  >
    <slot />
  </h2>

  <h3
    v-else-if="tag === 'h3'"
    class="text-xl font-semibold"
  >
    <slot />
  </h3>
</template>
