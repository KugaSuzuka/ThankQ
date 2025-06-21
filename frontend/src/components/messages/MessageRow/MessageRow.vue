<script setup lang="ts">
import BaseHandWrittenText from '@/components/Common/BaseHandWrittenText/BaseHandWrittenText.vue';


// defineProps<BaseTextProps>();
</script>

<template>
  <BaseHandWrittenText
    class="min-h-15 px-8 flex items-center
    border-b-1 border-dotted border-grey"
  >
    <slot />
  </BaseHandWrittenText>
</template>
