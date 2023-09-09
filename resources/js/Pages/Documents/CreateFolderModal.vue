<template>
  <modal :show="modelValue" @show="onShow" max-width="sm">
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Create New Folder
        </h2>
        <div class="mt-6">
            <InputLabel for="folderName" value="Folder Name" class="sr-only"/>
            <TextInput 
              type="text"
              ref="folderNameInput"
              id="folderName"
              class="mt-1 block w-full"
              placeholder="Folder Name"
            />
        </div>
        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
          <PrimaryButton class="ml-3" @click="createFolder">
            Submit
          </PrimaryButton>
        </div>
    </div>
  </modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from 'vue';

// Props & Emit
const {modelValue} = defineProps({
    modelValue: Boolean
});
const emit = defineEmits(['update:modelValue']);

// Refs
const folderNameInput = ref(null);

// Methods
function closeModal() {
  emit('update:modelValue', false);
}

function onShow() {
  nextTick(() => folderNameInput.value.focus());
}

function createFolder() {
  console.log("Create folder");
  closeModal();
}
</script>