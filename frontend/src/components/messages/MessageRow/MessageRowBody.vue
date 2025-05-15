<script setup lang="ts">
import MessageRow from './MessageRow.vue';

// defineProps<BaseTextProps>();


</script>

<template>
  <MessageRow>
    <p>
      <slot />
    </p>
  </MessageRow>
</template>
