<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="input input-bordered w-full input-sm border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-1"
        :value="modelValue"
        @input="$emit('update:modelValue', Number($event.target.value))"
        ref="input"
        min="0"
    />
</template>
