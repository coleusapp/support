import { createProPlugin, repeater, toggle, togglebuttons } from '@formkit/pro';
import { createInput } from '@formkit/vue';
import SwitchInput from './resources/js/components/form/SwitchInput.vue';

export const proPlugin = createProPlugin('fk-36c75313d', {
    repeater,
    toggle,
    togglebuttons,
});

export const inputs = {
    switch: createInput(SwitchInput),
};

