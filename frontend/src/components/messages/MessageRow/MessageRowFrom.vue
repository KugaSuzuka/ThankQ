<script setup lang="ts">
import MessageRow from './MessageRow.vue';

// defineProps<BaseTextProps>();

</script>

<template>
  <MessageRow class="items-center justify-end">
    <p
      class="text-left"
      style="min-width: 66px;"
    >
      <slot />
    </p>
  </MessageRow>
</template>
