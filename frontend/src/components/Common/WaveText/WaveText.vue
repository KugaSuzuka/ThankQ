<script setup lang="ts">
import type { WaveTextProps } from './Type';
defineProps<WaveTextProps>()

</script>

<template>
  <span class="inline-flex tracking-wider">
    <span
      v-for="(char, index) in text"
      :key="index"
      class="char"
      :style="{ animationDelay: `${index * 0.1}s` }"
    >
      {{ char }}
    </span>
  </span>
</template>

<style scoped>
.char {
  display: inline-block;
  animation: wave 3s infinite ease-in-out;
}

@keyframes wave {
  0%, 10% {
    transform: translateY(0);
  }
  20% {
    transform: translateY(-8px);
  }
  30% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(0);
  }
}
</style>
