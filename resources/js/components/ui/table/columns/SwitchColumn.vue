<script setup lang="ts">
import { onErrorToast, onSuccessToast, ToastType } from '@coleus/support/lib/inertia';
import { router } from '@inertiajs/vue3';
import type { RequestPayload } from '@inertiajs/core';
import { ref, watch } from 'vue';

const props = defineProps<{
    active: boolean;
    href: string;
    /** The full update request with the flipped value, since the update route validates every field. */
    payload: (active: boolean) => RequestPayload;
}>();

const checked = ref(props.active);

watch(
    () => props.active,
    (active) => (checked.value = active),
);

function change(active: boolean): void {
    checked.value = active;

    router.put(props.href, props.payload(active), {
        preserveScroll: true,
        ...onSuccessToast(ToastType.UPDATE_SUCCESS),
        ...onErrorToast(ToastType.ERROR),
        // Puts the switch back if the server refused the change.
        onFinish: () => (checked.value = props.active),
    });
}
</script>

<template>
    <UiSwitch :model-value="checked" @update:model-value="change" />
</template>
