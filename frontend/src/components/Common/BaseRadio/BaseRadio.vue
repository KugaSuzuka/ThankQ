<script setup lang="ts">
import type { BaseRadioProps } from './Type';

defineProps<BaseRadioProps>();
const model = defineModel<BaseRadioProps['value']>()
</script>

<template>
  <label
    class="flex justify-between border-1 p-4 radio-primary
      border-primary rounded-md"
    :class="{'bg-[#C4E9DA]': model === value}"
  >
    {{ label }}
    <input
      v-model="model"
      class="radio"
      :disabled
      type="radio"
      :value
    >
  </label>
</template>
