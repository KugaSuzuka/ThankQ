<script setup lang="ts">

defineProps<{
  toPath: string
  currentPath: string
  label: string
}>();


const activeClass = computed(() => {
  return 'bg-accent px-4 py-1 rounded-3xl flex'
})

</script>

<template>
  <button>
    <span :class="{[activeClass]: currentPath.includes(toPath)}">
      <slot />
    </span>
    <span class="text-xs">{{ label }}</span>
  </button>
</template>
