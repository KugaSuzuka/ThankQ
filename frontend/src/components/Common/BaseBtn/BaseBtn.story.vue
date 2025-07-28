<script setup lang="ts">
import BaseBtn from './BaseBtn.vue'
import type { BaseBtnProps, BaseBtnVariantType, BaseBtnBehaviorType } from './Type';
import type { ThankQColorType } from '@/themes/color';
import type { ThankQSizeType } from '@/themes/size';

const sizes: ThankQSizeType[] = ['xs', 'sm', 'md', 'lg', 'xl'];
const colors: (ThankQColorType | undefined)[] = [
  undefined, 'primary', 'secondary', 'accent', 'info', 'success', 'warning', 'error', 'neutral', 'base-100', 'base-200', 'base-300'
];
const variants = [undefined, 'outline', 'dash', 'soft', 'link', 'active'];
const behaviors = [undefined, 'wide', 'block', 'square', 'circle'];
</script>

<template>
  <Story
    group="common"
    :layout="{ type: 'grid', width: '200px' }"
    title="Common/BaseBtn"
  >
    <Variant title="Default">
      <BaseBtn size="md">
        ボタン
      </BaseBtn>
    </Variant>

    <Variant title="Sizes">
      <div class="flex gap-2 items-center">
        <BaseBtn
          v-for="size in sizes"
          :key="size"
          :size="size"
        >
          {{ size }}
        </BaseBtn>
      </div>
    </Variant>

    <Variant title="Colors">
      <div class="grid grid-cols-3 gap-2">
        <BaseBtn
          v-for="color in colors"
          :key="color || 'default'"
          :color="color"
          size="md"
        >
          {{ color || 'default' }}
        </BaseBtn>
      </div>
    </Variant>

    <Variant title="Variants">
      <div class="flex flex-wrap gap-2">
        <BaseBtn
          v-for="variant in variants"
          :key="variant || 'default'"
          color="primary"
          size="md"
          :variant="variant as BaseBtnVariantType | undefined"
        >
          {{ variant || 'default' }}
        </BaseBtn>
      </div>
    </Variant>

    <Variant title="Behaviors">
      <div class="space-y-2">
        <div
          v-for="behavior in behaviors"
          :key="behavior || 'default'"
          class="w-full"
        >
          <BaseBtn
            :behavior="behavior as BaseBtnBehaviorType | undefined"
            color="primary"
            size="md"
          >
            {{ behavior || 'default' }}
          </BaseBtn>
        </div>
      </div>
    </Variant>

    <Variant title="Loading State">
      <div class="flex gap-2">
        <BaseBtn
          color="primary"
          :loading="false"
          size="md"
        >
          Normal
        </BaseBtn>
        <BaseBtn
          color="primary"
          :loading="true"
          size="md"
        >
          Loading
        </BaseBtn>
      </div>
    </Variant>

    <Variant title="Interactive Example">
      <template #controls>
        <HstSelect
          v-model="state.size"
          :options="sizes"
          title="Size"
        />
        <HstSelect
          v-model="state.color"
          :options="[{ value: undefined, label: 'None' }, ...colors.filter(c => c).map(c => ({ value: c, label: c })) as any]"
          title="Color"
        />
        <HstSelect
          v-model="state.variant"
          :options="[{ value: undefined, label: 'None' }, ...variants.filter(v => v).map(v => ({ value: v, label: v })) as any]"
          title="Variant"
        />
        <HstSelect
          v-model="state.behavior"
          :options="[{ value: undefined, label: 'None' }, ...behaviors.filter(b => b).map(b => ({ value: b, label: b })) as any]"
          title="Behavior"
        />
        <HstCheckbox
          v-model="state.loading"
          title="Loading"
        />
        <HstText
          v-model="state.text"
          title="Text"
        />
      </template>
      
      <BaseBtn
        :behavior="state.behavior"
        :color="state.color"
        :loading="state.loading"
        :size="state.size"
        :variant="state.variant"
      >
        {{ state.text }}
      </BaseBtn>
    </Variant>
  </Story>
</template>

<script lang="ts">
export default {
  data() {
    return {
      state: {
        size: 'md' as ThankQSizeType,
        color: undefined as ThankQColorType | undefined,
        variant: undefined,
        behavior: undefined,
        loading: false,
        text: 'ボタン'
      }
    }
  }
}
</script>