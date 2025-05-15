<script setup lang="ts">
import { useQuiz } from '@/composables/useQuiz';
import { RouterView } from 'vue-router';
const { reloadQuiz } = useQuiz();

onMounted(async () => {
  await reloadQuiz()
})
</script>

<template>
  <RouterView />
</template>


