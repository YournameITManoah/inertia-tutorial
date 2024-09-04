<script setup lang="ts">
import { ref, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Paginator from "primevue/paginator";
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";

const props = defineProps({
    users: Object,
    filters: Object,
});

const search = ref(props.filters.search);

watch(search, (val) => {
    router.get(
        "/users",
        { search: val },
        { replace: true, preserveState: true }
    );
});

const onPageClick = (page) => {
    router.visit(
        props.users.links.find((l) => l.label === (page.page + 1).toString())
            .url,
        {
            replace: true,
        }
    );
};
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <DataTable
                    :value="users.data"
                    dataKey="id"
                    tableStyle="min-width: 50rem"
                >
                    <template #header>
                        <div
                            class="flex flex-wrap gap-2 items-center justify-between"
                        >
                            <h4 class="m-0">Manage Users</h4>
                            <IconField>
                                <InputIcon class="pi pi-search" />
                                <InputText
                                    v-model="search"
                                    type="search"
                                    placeholder="Search..."
                                />
                            </IconField>
                        </div>
                    </template>
                    <Column field="name" header="Name"></Column>
                    <Column>
                        <template #body="slotProps">
                            <Link :href="`/users/edit/${slotProps.data.id}`">
                                Edit
                            </Link>
                        </template>
                    </Column>
                    <template #footer>
                        <Paginator
                            :alwaysShow="false"
                            :rows="users.per_page"
                            :totalRecords="users.total"
                            :first="users.per_page * (users.current_page - 1)"
                            @page="onPageClick"
                        />
                    </template>
                </DataTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
