<template>
  <svg
    v-for="(_, i) in hearts"
    :key="i"
    ref="heartRefs"
    class="heart"
    viewBox="0 0 24 24"
  >
    <path
      d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
          2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09
          C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5
          c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
      fill="red"
    />
  </svg>
</template>

<script setup lang="ts">
import gsap from 'gsap'

const NUM_HEARTS = 150
const hearts = Array.from({ length: NUM_HEARTS })

const heartRefs = ref<SVGSVGElement[]>([])

onMounted(() => {
  // 初期配置: ランダム位置・ランダムスケール・非表示
  heartRefs.value.forEach((el) => {
    gsap.set(el, {
      x: (window.innerWidth) / 2,
      y: (window.innerHeight) / 2,
      scale: 0.4 + Math.random() * 0.6,
      opacity: 0,
    })
  })

  // ランダムに拡散するアニメーション
  gsap.to(heartRefs.value, {
    x: () => Math.random() * (window.innerWidth - 48),
    y: () => Math.random() * (window.innerHeight - 48),
    opacity: 1,
    scale: () => 0.5 + Math.random() * 0.5,
    duration: 1.5,
    ease: 'power2.out',
    stagger: 0.02,
  })

  setTimeout(() => {
    gsap.to(heartRefs.value, {
      x: window.innerWidth / 2,
      y: window.innerHeight / 2,
      opacity: 0,
      duration: 2,
      ease: 'power2.out',
      stagger: 0.01,
    })
  }, 2000)
})
</script>

<style scoped>
.heart {
  position: absolute;
  width: 24px;
  height: 24px;
}
</style>
