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
              v-model="form.name"
            />
            <InputError :message="form.errors.name" class="mt-2"/>
        </div>
        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
          <PrimaryButton class="ml-3" @click="createFolder" :disable="form.processing">
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
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";

// Props & Emit
const {modelValue} = defineProps({
    modelValue: Boolean
});
const emit = defineEmits(['update:modelValue']);

// Refs
const folderNameInput = ref(null);

// Uses
const form = useForm({
    name: '',
    parent_id: null
})
const page = usePage();

// Methods
function closeModal() {
  emit('update:modelValue', false);
  form.clearErrors();
  form.reset()
}

function onShow() {
  nextTick(() => folderNameInput.value.focus());
}

function createFolder() {
  form.parent_id = page.props?.folder?.id
    form.post(route('folder.create'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            form.reset();
        },
        onError: () => folderNameInput.value.focus()
    })
}
</script>