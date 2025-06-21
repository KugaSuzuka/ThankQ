<script setup lang="ts">

const props = defineProps<{
  step: number,
  currentStep: number,
}>();

const isPassed = computed(() => {
  return props.currentStep >= props.step
})

</script>

<template>
  <li
    class="step"
    :class="{
      'step-primary': isPassed
    }"
  />
</template>

<style>
.step {
  min-width: 3rem;
}
</style>
