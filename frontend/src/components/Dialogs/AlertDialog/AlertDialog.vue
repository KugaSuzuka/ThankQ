<script setup lang="ts">
import BaseIcon from '@/components/Common/BaseIcon/BaseIcon.vue';
import BaseDialog from '../BaseDialog/BaseDialog.vue';
import BaseText from '@/components/Common/BaseText/BaseText.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import type { AlertDialogPropsType } from './Type.ts';

defineProps<AlertDialogPropsType>();
const dialogRef = useTemplateRef('base-dialog');

function close() {
  dialogRef.value?.closeDialog();
}
</script>

<template>
  <BaseDialog ref="base-dialog">
    <template #heading>
      <BaseHeading
        class="flex items-center gap-1"
        tag="h3"
      >
        <BaseIcon
          color="error"
          icon="error"
        />
        {{ title }}
      </BaseHeading>
    </template>

    <BaseText
      v-if="typeof body === 'string'"
      class="w-full break-words whitespace-normal whitespace-pre my-6"
    >
      {{ body }}
    </BaseText>
    <template v-else>
      <BaseText
        v-for="b, index in body"
        :key="index"
      >
        {{ b }}
      </BaseText>
    </template>

    <template #footer>
      <BaseBtn
        color="error"
        size="md"
        @click="close"
      >
        閉じる
      </BaseBtn>
    </template>
  </BaseDialog>
</template>
