<script setup lang="ts">

// defineProps<BaseTextProps>();
</script>

<template>
  <p
    class="tracking-wide text-base hand-written font-semibold"
  >
    <slot />
  </p>
</template>

<style scoped>
.hand-written {
  font-family: 'Zen Kurenaido', sans-serif;
  color: #121212;
}
</style>
