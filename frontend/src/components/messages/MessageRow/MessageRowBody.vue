<script setup lang="ts">
import MessageRow from './MessageRow.vue';

// defineProps<BaseTextProps>();


</script>

<template>
  <MessageRow>
    <p class="text-lg font-semibold">
      <slot />
    </p>
  </MessageRow>
</template>
