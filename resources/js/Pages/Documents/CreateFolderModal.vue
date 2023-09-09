<template>
  <modal :show="modelValue" max-width="sm">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create New Folder
        </h2>
        <div class="mt-6">
            <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
            <TextInput type="text"/>
        </div>
        <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
        </div>
    </div>
  </modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

// Props & Emit
const {modelValue} = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])

// Methods
function closeModal() {
  emit('update:modelValue', false);
}
</script>