<script setup lang="ts">
import BaseDivider from '@/components/Common/BaseDivider/BaseDivider.vue';
import type { ConfirmListItemProps } from './Type';
import BaseText from '@/components/Common/BaseText/BaseText.vue';
defineProps<ConfirmListItemProps>();

</script>

<template>
  <li>
    <BaseText bold>
      Q. {{ question }}
    </BaseText>
    <BaseText class="pt-2">
      A. {{ answerOfUser }}
    </BaseText>
    <BaseDivider
      v-if="!noBorder"
      class="my-4"
    />
  </li>
</template>
