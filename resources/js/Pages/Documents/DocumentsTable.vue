<template>
  <div class="flex-1 overflow-auto">
    <table class="min-w-full">
        <thead class="bg-gray-100 border-b">
        <tr>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left w-[30px] max-w-[30px] pr-0">
                <Checkbox @change="onSelectAllChange" v-model:checked="allSelected"/>
            </th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">

            </th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Name
            </th>
            <th v-if="search" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Path
            </th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Owner
            </th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Last Modified
            </th>
            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                Size
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="file of files.data" key="files.id"
          class="border-b transition duration-300 ease-in-out hover:bg-blue-100 cursor-pointer">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 w-[30px] max-w-[30px] pr-0">
                <Checkbox />
            </td>
            <td class="px-6 py-4 max-w-[40px] text-sm font-medium text-gray-900 text-yellow-500">

            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex items-center">
                {{ file.name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ file.owner }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ file.created_by }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ file.updated_at }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ file.size }}
            </td>
        </tr>
        </tbody>
      </table>
    </div>
</template>

<script setup>
import Checkbox from "@/Components/Checkbox.vue";

// Props & Emit
const { files } = defineProps({
    files: Object
});

</script>