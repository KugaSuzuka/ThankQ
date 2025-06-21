<script lang="ts">
import AlertDialog from '@/components/Dialogs/AlertDialog/AlertDialog.vue';
import PhotosDialog from '@/components/Dialogs/PhotosDialog/PhotosDialog.vue';

export default {
  components: {
    AlertDialog,
    PhotosDialog,
  },
}
</script>
<script setup lang="ts">
import { useDialogStore } from '@/stores/dialogStore';

// import type { GlobalHeaderProps } from './Type';

// defineProps<GlobalHeaderProps>();
const store = useDialogStore();

</script>

<template>
  <component
    :is="dialog.component"
    v-for="dialog, index in store.dialogs"
    :key="index"
    v-bind="dialog.props"
  />
</template>
