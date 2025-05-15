<script setup lang="ts">
const sectionRef = useTemplateRef('section');

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
    class="h-full p-6 overflow-auto"
  >
    <slot />
  </section>
</template>


