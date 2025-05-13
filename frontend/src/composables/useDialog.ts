import { useDialogStore, type DialogType } from "@/stores/dialogStore"

export function useDialog() {
  const store = useDialogStore();

  return {
    open: (dialog: string, props: DialogType['props']) => {
      store.pushDialog({
        component: dialog,
        props,
      });
    },
    close: (component: string) => {
      store.removeDialog(component);
    }
  }
}
