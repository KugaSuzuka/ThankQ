<script setup lang="ts">
import { myDayJs } from '@/utils/myDayJs';

defineProps({});
defineEmits({})
defineExpose({
  hoge() {
    return 'a';
  }
})

// Composables


// LocalState
const progress = ref(40);
useRefHistory(progress)
// functions
function hoge() {
  // eslint-disable-next-line no-console
  console.log('hoge');
}

// watches
watch(progress, () => {
  // eslint-disable-next-line no-console
  console.log('watch')
})

// lifeCycles
onMounted(() => {
  hoge();
  // eslint-disable-next-line no-console
  console.log('now', myDayJs.now())
})

</script>

<template>
  <input
    v-if="true"
    v-model="progress"
    class="range"
    max="100"
    min="0"
    type="range"
  >
</template>

