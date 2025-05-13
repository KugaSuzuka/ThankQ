export interface BaseRadioGroupProps {
  radioItems: {
    label: string,
    value: number | string | boolean
  }[],
  disabled?: boolean
};
