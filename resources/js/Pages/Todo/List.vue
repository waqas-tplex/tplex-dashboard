<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3'
import Select from 'datatables.net-select';
 
DataTable.use(Select);
const columns = [
  { data: 'id', title: "ID"},
  { data: 'title',title: "Title" },
  { data: 'description', title: "Description"},
  { data: 'ends_at', title: "Ends_at"},
  { data: 'priority', title: "Priority"}
];
defineProps({
    todos: Array,
})
</script>

<template>
    <Head title="Our Team" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Our Team</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pt-10 pb-10 px-4">
                    <DataTable
                        :options="{order: [4, 'asc']}"
                        :data="todos"
                        class="display"
                        :columns="columns"
                    >
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
@import 'datatables.net-dt';
.dataTables_wrapper .dataTables_length select {
    padding-right: 2.5rem !important;
}
</style>
