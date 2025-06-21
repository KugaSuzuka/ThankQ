<script setup lang="ts">
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import type { BaseDialogProps } from './Type';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseIcon from '@/components/Common/BaseIcon/BaseIcon.vue';

defineProps<BaseDialogProps>();
const dialogRef = useTemplateRef('BaseDialog');

defineExpose({
  open,
  closeDialog
})

function open() {
  dialogRef.value?.showModal();
}

function closeDialog() {
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
    ref="BaseDialog"
    class="modal base-dialog"
    :class="[modalClass]"
  >
    <BaseBtn
      v-if="closeIcon"
      behavior="circle"
      class="absolute top-4 right-2"
      color="neutral"
      size="lg"
      variant="outline"
      @click="closeDialog"
    >
      <BaseIcon
        icon="close"
      />
    </BaseBtn>
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

      <footer
        v-if="$slots.footer"
        class="modal-action"
      >
        <slot name="footer" />
      </footer>
    </BaseStack>
    <form
      class="modal-backdrop"
      method="dialog"
    >
      <button />
    </form>
  </dialog>
</template>
