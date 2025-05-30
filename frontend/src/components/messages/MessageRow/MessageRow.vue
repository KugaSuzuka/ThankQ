<script setup lang="ts">

// defineProps<BaseTextProps>();
</script>

<template>
  <div
    class="tracking-wide text-base message-row min-h-15 px-8 flex items-center
    border-b-1 border-dotted border-grey"
  >
    <slot />
  </div>
</template>

<style scoped>
.message-row {
  font-family: 'Zen Kurenaido', sans-serif;
  font-weight: 500;
  color: #121212;
}
</style>
