<script setup lang="ts">
import type { TypeWriterProps } from './Type';


const props = defineProps<TypeWriterProps>();
const emits = defineEmits<{ finish: []}>()
const displayedText = ref('')

function sleep(ms: number) {
  return new Promise(resolve => setTimeout(resolve, ms))
}

async function typeText() {
  for (const char of props.text) {
    displayedText.value += char
    let delay = (props.typeSpeed ?? 5) + Math.random() * 100
    if (['、', '。', '！', '？', '.', ','].includes(char)) {
      delay += 300 // さらに300ms足す
    }
    await sleep(delay)
  }
}


onMounted(async () => {
  await typeText()
  emits('finish')
})
</script>

<template>
  <span class="text-left">{{ displayedText }}</span>
</template>
