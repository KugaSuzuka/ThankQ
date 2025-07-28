<script setup lang="ts">
import BaseCard from './BaseCard.vue'
import type { ThankQSizeType } from '@/themes/size';
import type { ThankQColorType } from '@/themes/color';

const shadows: (ThankQSizeType | undefined)[] = [undefined, 'xs', 'sm', 'md', 'lg', 'xl'];
const bgColors: (ThankQColorType | undefined)[] = [
  undefined, 'primary', 'secondary', 'accent', 'info', 'success', 'warning', 'error', 'neutral', 'base-100', 'base-200', 'base-300'
];
</script>

<template>
  <Story
    group="common"
    :layout="{ type: 'grid', width: '300px' }"
    title="Common/BaseCard"
  >
    <Variant title="Default">
      <BaseCard>
        <h3 class="text-lg font-bold">
          カードタイトル
        </h3>
        <p class="mt-2">
          カードの内容です。ここに任意のコンテンツを配置できます。
        </p>
      </BaseCard>
    </Variant>

    <Variant title="Shadow Variations">
      <div class="space-y-4">
        <div
          v-for="shadow in shadows"
          :key="shadow || 'none'"
        >
          <BaseCard :shadow="shadow">
            <h4 class="font-semibold">
              Shadow: {{ shadow || 'none' }}
            </h4>
            <p class="text-sm">
              シャドウサイズ「{{ shadow || 'なし' }}」のカードです。
            </p>
          </BaseCard>
        </div>
      </div>
    </Variant>

    <Variant title="Content Examples">
      <div class="space-y-4">
        <BaseCard shadow="md">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-primary-content font-bold">
              U
            </div>
            <div>
              <h4 class="font-semibold">
                ユーザー情報
              </h4>
              <p class="text-sm text-base-content/70">
                user@example.com
              </p>
            </div>
          </div>
        </BaseCard>

        <BaseCard shadow="lg">
          <h3 class="text-lg font-bold mb-3">
            統計情報
          </h3>
          <div class="grid grid-cols-2 gap-4">
            <div class="text-center">
              <div class="text-2xl font-bold text-primary">
                1,234
              </div>
              <div class="text-sm text-base-content/70">
                訪問者数
              </div>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold text-success">
                567
              </div>
              <div class="text-sm text-base-content/70">
                コンバージョン
              </div>
            </div>
          </div>
        </BaseCard>

        <BaseCard shadow="sm">
          <div class="flex items-center justify-between">
            <div>
              <h4 class="font-semibold">
                通知設定
              </h4>
              <p class="text-sm text-base-content/70">
                メール通知を受け取る
              </p>
            </div>
            <input
              checked
              class="toggle toggle-primary"
              type="checkbox"
            >
          </div>
        </BaseCard>
      </div>
    </Variant>

    <Variant title="Interactive Example">
      <template #controls>
        <HstSelect
          v-model="state.shadow"
          :options="[{ value: undefined, label: 'None' }, ...shadows.filter(s => s).map(s => ({ value: s, label: s })) as any]"
          title="Shadow"
        />
        <HstText
          v-model="state.title"
          title="Title"
        />
        <HstTextarea
          v-model="state.content"
          title="Content"
        />
      </template>

      <BaseCard :shadow="state.shadow">
        <h3
          v-if="state.title"
          class="text-lg font-bold"
        >
          {{ state.title }}
        </h3>
        <p
          v-if="state.content"
          :class="state.title ? 'mt-2' : ''"
        >
          {{ state.content }}
        </p>
      </BaseCard>
    </Variant>
  </Story>
</template>

<script lang="ts">
export default {
  data() {
    return {
      state: {
        shadow: 'md' as ThankQSizeType | undefined,
        title: 'カードタイトル',
        content: 'カードの内容です。ここに任意のコンテンツを配置できます。'
      }
    }
  }
}
</script>
