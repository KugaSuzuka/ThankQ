<script setup lang="ts">
import type { BaseStepperProps } from './Type';
import BaseStepperItem from './BaseStepperItem.vue';

defineProps<BaseStepperProps>();

</script>

<template>
  <ul class="steps w-full">
    <BaseStepperItem
      v-for="step in stepLength"
      :key="step"
      :current-step
      :step="step - 1"
    />
  </ul>
</template>
