<script setup lang="ts">
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import MessageRow from './MessageRow.vue';

// defineProps<BaseTextProps>();


</script>

<template>
  <MessageRow>
    <BaseHeading tag="h3">
      <slot />
    </BaseHeading>
  </MessageRow>
</template>
