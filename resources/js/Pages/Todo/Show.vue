<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

let todo = {
    id: null,
    title: "",
    description: "",
    priority: null,
    ends_at: "",
}

if(usePage().props.todo) {
    todo = usePage().props.todo;
}

const form = useForm(todo);

const submit = () => {
    if (todo.id) {
        form.put(route('to-do-list.update', todo.id), {
            onSuccess: (res) => form.reset()
        });
    } else {
        form.post(route('to-do-list.store'), {
            onSuccess: (res) => form.reset()
        })
    }
}; 
</script>

<template>
    <Head title="ToDo" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">ToDo</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pt-10 pb-10 px-4">
                    <div
                        v-if="$page.props.message"
                        class="p-4 mb-4 text-sm text-white bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 text-center"
                        role="alert"
                    >
                        <span class="font-medium">
                            {{ $page.props.message }}
                        </span>
                    </div>
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                placeholder="Title"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="description" value="Description?" />

                            <Textarea
                                id="description"
                                type="password"
                                placeholder="Type your description here..."
                                class="mt-1 block w-full"
                                v-model="form.description"
                                required
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="priority" value="priority" />

                            <TextInput
                                id="priority"
                                type="number"
                                placeholder="0-100"
                                class="mt-1 block w-full"
                                v-model="form.priority"
                                required
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.priority" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="ends_at" value="Ends At" />

                            <TextInput
                                id="ends_at"
                                type="datetime-local"
                                class="mt-1 block w-full"
                                v-model="form.ends_at"
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.ends_at" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

