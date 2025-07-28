<script setup lang="ts">
import BaseHeading from './BaseHeading.vue'

const tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as const;
</script>

<template>
  <Story
    group="common"
    :layout="{ type: 'single', iframe: false }"
    title="Common/BaseHeading"
  >
    <Variant title="Default">
      <BaseHeading tag="h1">
        デフォルトの見出し
      </BaseHeading>
    </Variant>

    <Variant title="All Heading Levels">
      <div class="space-y-4">
        <div
          v-for="tag in tags"
          :key="tag"
        >
          <BaseHeading :tag="tag">
            {{ tag.toUpperCase() }}: このレベルの見出しです
          </BaseHeading>
        </div>
      </div>
    </Variant>

    <Variant title="Content Examples">
      <div class="space-y-6">
        <div>
          <BaseHeading tag="h1">
            メインタイトル
          </BaseHeading>
          <p class="mt-2 text-base-content/70">
            これはメインタイトルの例です。最も重要な見出しに使用します。
          </p>
        </div>

        <div>
          <BaseHeading tag="h2">
            セクションタイトル
          </BaseHeading>
          <p class="mt-2 text-base-content/70">
            これはセクションタイトルの例です。コンテンツの大きな区分に使用します。
          </p>
        </div>

        <div>
          <BaseHeading tag="h3">
            サブセクションタイトル
          </BaseHeading>
          <p class="mt-2 text-base-content/70">
            これはサブセクションタイトルの例です。セクション内の小見出しに使用します。
          </p>
        </div>
      </div>
    </Variant>

    <Variant title="Interactive Example">
      <template #controls>
        <HstSelect
          v-model="state.tag"
          :options="tags.map(t => ({ value: t, label: t.toUpperCase() }))"
          title="Tag"
        />
        <HstText
          v-model="state.text"
          title="Text"
        />
      </template>
      
      <BaseHeading :tag="state.tag">
        {{ state.text }}
      </BaseHeading>
    </Variant>

    <Variant title="Hierarchy Example">
      <div class="space-y-3">
        <BaseHeading tag="h1">
          1. ドキュメントタイトル
        </BaseHeading>
        <div class="ml-4">
          <BaseHeading tag="h2">
            1.1 章タイトル
          </BaseHeading>
          <div class="ml-4">
            <BaseHeading tag="h3">
              1.1.1 節タイトル
            </BaseHeading>
            <p class="ml-4 mt-2 text-base-content/70">
              ここに本文が入ります。見出しの階層構造を示すサンプルです。
            </p>
          </div>
        </div>
      </div>
    </Variant>
  </Story>
</template>

<script lang="ts">
export default {
  data() {
    return {
      state: {
        tag: 'h1' as 'h1' | 'h2' | 'h3' | 'h4' | 'h5' | 'h6',
        text: 'サンプル見出し'
      }
    }
  }
}
</script>