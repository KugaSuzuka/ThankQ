<script setup lang="ts">
import type { BaseSectionProps } from './Type';

const props = defineProps<BaseSectionProps>()

const sectionRef = useTemplateRef('section');

const height = computed(() => {
  if (props.noHFull) return '';

  return 'h-full';
})

function scrollToTop() {
  sectionRef.value?.scroll({
    top: 0,
    behavior: "smooth",
  })
}

defineExpose({
  scrollToTop
})
</script>

<template>
  <section
    ref="section"
    class="p-6 overflow-auto"
    :class="[height]"
  >
    <slot />
  </section>
</template>


