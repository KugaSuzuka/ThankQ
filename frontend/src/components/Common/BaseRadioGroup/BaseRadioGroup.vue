<script setup lang="ts">
import BaseRadio from '../BaseRadio/BaseRadio.vue';
import type { BaseRadioProps } from '../BaseRadio/Type';
import type { BaseRadioGroupProps } from './Type';

defineProps<BaseRadioGroupProps>();
const model = defineModel<BaseRadioProps['value']>()

</script>

<template>
  <div class="flex flex-col gap-3">
    <BaseRadio
      v-model="model"
      v-for="radio, index in radioItems"
      :key="index"
      :disabled
      :label="radio.label"
      :value="radio.value"
    />
  </div>
</template>
