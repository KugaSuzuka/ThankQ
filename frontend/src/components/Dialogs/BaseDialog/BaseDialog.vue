<script setup lang="ts">
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import type { BaseDialogProps } from './Type';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';

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
    :class="[modalClass]"
  >
    <BaseStack
      class="modal-box"
      :class="[contentClass]"
      component="section"
    >
      <BaseHeading tag="h3">
        <slot name="heading">
          {{ title }}
        </slot>
      </BaseHeading>

      <BaseStack
        class="flex-grow"
        component="div"
      >
        <slot />
      </BaseStack>
      <div
        v-if="$slots.footer"
        class="modal-action"
      >
        <form
          class="modal-backdrop"
          method="dialog"
        >
          <slot name="footer" />
        </form>
      </div>
    </BaseStack>
    <form
      class="modal-backdrop"
      method="dialog"
    >
      <button>close</button>
    </form>
  </dialog>
</template>
