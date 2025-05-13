<script setup lang="ts">
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import type { BaseDialogProps } from './Type';

defineProps<BaseDialogProps>();
const dialogRef = useTemplateRef('AlertDialog');

defineExpose({
  open,
  close
})

function open() {
  dialogRef.value?.showModal();
}

function close() {
  dialogRef.value?.close();
}

function init() {
  open();
}

onMounted(() => {
  init()
});
</script>

<template>
  <dialog
    ref="AlertDialog"
    class="modal"
  >
    <div class="modal-box">
      <BaseHeading tag="h3">
        <slot name="heading">
          {{ title ?? 'ここにタイトルが入ります' }}
        </slot>
      </BaseHeading>

      <div class="py-4">
        <slot />
      </div>

      <div
        v-if="$slots.footer"
        class="modal-action"
      >
        <form method="dialog">
          <slot name="footer" />
        </form>
      </div>
    </div>
  </dialog>
</template>
