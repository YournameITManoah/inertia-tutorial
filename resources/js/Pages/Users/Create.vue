<script setup lang="ts">
import { ref, reactive, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

import InputText from "primevue/inputtext";
import Password from "primevue/password";
import Button from "primevue/button";

const props = defineProps({});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Create New User
            </h2>
        </template>

        <div class="p-4 max-w-screen-md mx-auto">
            <form @submit.prevent="form.post('/users')">
                <label for="name" class="block text-900 font-medium mb-2">
                    Name
                </label>
                <InputText
                    v-model="form.name"
                    id="name"
                    name="name"
                    type="text"
                    class="mb-3"
                    fluid
                    required
                />
                <div v-if="form.errors.name" class="text-red-500">
                    {{ form.errors.name }}
                </div>

                <label for="email" class="block text-900 font-medium mb-2">
                    Email
                </label>
                <InputText
                    v-model="form.email"
                    id="email"
                    name="email"
                    type="email"
                    class="mb-3"
                    fluid
                    required
                />
                <div v-if="form.errors.email" class="text-red-500">
                    {{ form.errors.email }}
                </div>

                <label for="password" class="block text-900 font-medium mb-2">
                    Password
                </label>
                <Password
                    v-model="form.password"
                    inputId="password"
                    :input-props="{ name: 'password' }"
                    required
                    toggleMask
                    fluid
                    class="mb-3"
                />
                <div v-if="form.errors.password" class="text-red-500">
                    {{ form.errors.password }}
                </div>

                <label
                    for="password_confirmation"
                    class="block text-900 font-medium mb-2"
                >
                    Password Confirmation
                </label>
                <Password
                    v-model="form.password_confirmation"
                    inputId="password_confirmation"
                    :input-props="{ name: 'password_confirmation' }"
                    required
                    toggleMask
                    fluid
                    class="mb-3"
                />

                <Button
                    type="submit"
                    label="Submit"
                    :loading="form.processing"
                    fluid
                ></Button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
