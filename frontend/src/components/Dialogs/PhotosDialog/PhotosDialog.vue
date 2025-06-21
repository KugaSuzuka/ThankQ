<script setup lang="ts">
import BaseDialog from '../BaseDialog/BaseDialog.vue';
import type { PhotosDialogProps } from './Type.ts';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import InstaxCard from '@/components/messages/ InstaxCard/ InstaxCard.vue';

const props = defineProps<PhotosDialogProps>();

const instaxList = useTemplateRef('instax-list');


onMounted(async () => {
  await nextTick();
  instaxList.value?.[props.currentIndex]?.$el.scrollIntoView({
    behavior: 'smooth',
  });
});


</script>

<template>
  <BaseDialog
    ref="base-dialog"
    close-icon
    content-class="max-h-8/10 rounded-none bg-transparent p-1"
    no-h-full
  >
    <BaseStack
      v-motion-fade-visible
      class="justify-center modal-backdrop"
      component="div"
      :duration="800"
      gap="md"
      grow
    >
      <InstaxCard
        v-for="imgItem, index in imgList"
        :key="index"
        ref="instax-list"
        :src="imgItem.url"
        :tap-icon="false"
      >
        <img
          :src="imgItem.url"
        >
      </InstaxCard>
    </BaseStack>
  </BaseDialog>
</template>
