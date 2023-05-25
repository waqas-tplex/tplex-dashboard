<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Textarea from '@/Components/Textarea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});

const submit = () => {
    form.post(route('contact-us'), {
        onSuccess: (res) => form.reset()
    });
}; 
</script>

<template>
    <Head title="Contact Us" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Contact Us</h2>
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
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="text"
                                placeholder="John Doe"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                placeholder="abc@xyz.com"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="phone" value="Phone (Optional)" />

                            <TextInput
                                id="phone"
                                type="text"
                                placeholder="(+1) 310 402 2381"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="message" value="How can we help you?" />

                            <Textarea
                                id="message"
                                type="password"
                                placeholder="Type your message here..."
                                class="mt-1 block w-full"
                                v-model="form.message"
                                required
                                autocomplete="off"
                            />

                            <InputError class="mt-2" :message="form.errors.message" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Send
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

