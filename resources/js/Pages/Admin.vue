<template>
    <admin-layout title="Преподаватели">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Админ панель
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <jet-form-section @submitted="assignRole">
                                    <template #title>
                                        Добавление роли пользователю
                                    </template>

                                    <template #form>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="role" value="Роль" />
                                            <select name="role" id="role" v-model="form.role" ref="role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                                <option v-for="option in rolesData" v-bind:value="option.id">
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="email" value="Почта пользователя" />
                                            <jet-input id="email" type="email" class="block w-full" v-model="form.email" ref="email" required />
                                        </div>
                                    </template>

                                    <template #actions>
                                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                            Добавлено.
                                        </jet-action-message>

                                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Добавить
                                        </jet-button>
                                    </template>
                                </jet-form-section>

                                <jet-section-border />

                                <jet-form-section @submitted="assignPermission">
                                    <template #title>
                                        Добавление разрешения пользователю
                                    </template>

                                    <template #form>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="permission" value="Разрешение" />
                                            <select name="permission" id="permission" v-model="formPerm.perm" ref="permission" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                                <option v-for="option in permissionsData" v-bind:value="option.id">
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="email2" value="Почта пользователя" />
                                            <jet-input id="email2" type="email" class="block w-full" v-model="formPerm.email" ref="email2" required />
                                        </div>
                                    </template>

                                    <template #actions>
                                        <jet-action-message :on="formPerm.recentlySuccessful" class="mr-3">
                                            Добавлено.
                                        </jet-action-message>

                                        <jet-button :class="{ 'opacity-25': formPerm.processing }" :disabled="formPerm.processing">
                                            Добавить
                                        </jet-button>
                                    </template>
                                </jet-form-section>

                                <jet-section-border />

                                <jet-form-section @submitted="assignPermissionToRole">
                                    <template #title>
                                        Добавление разрешения роли
                                    </template>

                                    <template #form>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="permission2" value="Разрешение" />
                                            <select name="permission2" id="permission2" v-model="formPermToRole.perm" ref="permission2" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                                <option v-for="option in permissionsData" v-bind:value="option.id">
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-4">
                                            <jet-label for="role2" value="Роль" />
                                            <select name="role2" id="role2" v-model="formPermToRole.role" ref="role2" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                                <option v-for="option in rolesData" v-bind:value="option.id">
                                                    {{ option.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </template>

                                    <template #actions>
                                        <jet-action-message :on="formPermToRole.recentlySuccessful" class="mr-3">
                                            Добавлено.
                                        </jet-action-message>

                                        <jet-button :class="{ 'opacity-25': formPermToRole.processing }" :disabled="formPermToRole.processing">
                                            Добавить
                                        </jet-button>
                                    </template>
                                </jet-form-section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import {Link} from "@inertiajs/inertia-vue3";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSectionBorder from "@/Jetstream/SectionBorder";
const axios = require('axios');

export default {
    name: "Admin",
    components: {
        AdminLayout,
        Link,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSectionBorder,
    },
    data() {
        return {
            form: this.$inertia.form({
                role: '',
                email: '',
            }),
            formPerm: this.$inertia.form({
                perm: '',
                email: '',
            }),
            formPermToRole: this.$inertia.form({
                role: '',
                perm: '',
            }),
            rolesData: {},
            permissionsData: {},
        }
    },
    created() {
        this.getRoles();
        this.getPermissions();
    },
    methods: {
        assignRole() {
            this.form.put(route('api.admin.role.assign'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    console.log('error');
                }
            })
        },
        assignPermission() {
            this.formPerm.put(route('api.admin.permission.assign'), {
                preserveScroll: true,
                onSuccess: () => this.formPerm.reset(),
                onError: () => {
                    console.log('error');
                }
            })
        },
        assignPermissionToRole() {
            this.formPermToRole.put(route('api.admin.permission.assign.role'), {
                preserveScroll: true,
                onSuccess: () => this.formPermToRole.reset(),
                onError: () => {
                    console.log('error');
                }
            })
        },
        getRoles() {
            axios
                .get(route('api.admin.role.all'))
                .then((res) => {
                    console.log(res.data);
                    this.rolesData = res.data;
                });
        },
        getPermissions() {
            axios
                .get(route('api.admin.permission.all'))
                .then((res) => {
                    console.log(res.data);
                    this.permissionsData = res.data;
                });
        },
    }
}
</script>

<style scoped>

</style>
