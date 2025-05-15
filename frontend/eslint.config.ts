import pluginVue from "eslint-plugin-vue"
import { defineConfigWithVueTs, vueTsConfigs } from "@vue/eslint-config-typescript"
import pluginVitest from "@vitest/eslint-plugin"

// To allow more languages other than `ts` in `.vue` files, uncomment the following lines:
// import { configureVueProject } from '@vue/eslint-config-typescript'
// configureVueProject({ scriptLangs: ['ts', 'tsx'] })
// More info at https://github.com/vuejs/eslint-config-typescript/#advanced-setup

export default defineConfigWithVueTs(
  {
    name: "app/files-to-lint",
    files: ["**/*.{ts,mts,tsx,vue}"],
  },
  {
    name: "app/files-to-ignore",
    ignores: ["**/dist/**", "**/dist-ssr/**", "**/coverage/**"],
  },
  pluginVue.configs["flat/essential"],
  pluginVue.configs["flat/strongly-recommended"],
  pluginVue.configs["flat/essential"],
  vueTsConfigs.recommendedTypeChecked,
  vueTsConfigs.strictTypeChecked,
  vueTsConfigs.stylisticTypeChecked,
  {
    ...pluginVitest.configs.recommended,
    files: ["src/**/__tests__/*"],
  },
  {
    rules: {
      "vue/define-macros-order": ["error", {
        "order": ["defineProps", "defineEmits"],
        "defineExposeLast": false,
      }],
      "vue/no-undef-components": ["error"],
      "vue/max-len": ["error", {
        "code": 100,
        "template": 100,
        "ignoreUrls": true,
        "ignoreTemplateLiterals": false,
        "ignoreRegExpLiterals": false,
        "ignoreHTMLAttributeValues": false,
        "ignoreHTMLTextContents": false,
      }],
      "vue/attributes-order": ["error", {
        "order": [
          "CONDITIONALS",
          "TWO_WAY_BINDING",
          "DEFINITION",
          "LIST_RENDERING",
          "RENDER_MODIFIERS",
          "GLOBAL",
          ["UNIQUE", "SLOT"],
          "OTHER_DIRECTIVES",
          "OTHER_ATTR",
          "EVENTS",
          "CONTENT"
        ],
        "alphabetical": true
      }],
      "no-console": ["error"],
      "eqeqeq": ["error"],
    }
  },
)
