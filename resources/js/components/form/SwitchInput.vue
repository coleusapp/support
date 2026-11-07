<script setup lang="ts">
import type { FormKitFrameworkContext } from '@formkit/core';

const props = defineProps<{
    context: FormKitFrameworkContext;
}>();
</script>

<template>
    <UiSwitch
        :id="props.context.id"
        :model-value="Boolean(props.context._value)"
        :disabled="Boolean(props.context.disabled)"
        @update:model-value="(value: boolean) => props.context.node.input(value)"
    />
</template>
