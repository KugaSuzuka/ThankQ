import { defineStore } from 'pinia'

export interface DialogType {
  component: string,
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  props: Record<string, any>;
}


export const useDialogStore = defineStore('dialogs', () => {
  const dialogs = ref<DialogType[]>([]);

  function pushDialog(dialog: DialogType) {
    dialogs.value.push(dialog);
  };

  function removeDialog(component: string) {
    dialogs.value = dialogs.value.filter((dialog) => {
      return dialog.component !== component;
    })
  }
  return {
    dialogs,
    pushDialog,
    removeDialog,
  };
})
