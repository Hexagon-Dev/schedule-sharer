<template>
    <admin-layout :title="`Роль ` + roleData.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Роль {{ roleData.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-6">
                                    <form @submit.prevent="savePermissions">
                                        <div class="flex flex-col">
                                            <label v-for="perm in allPerms" :key="perm.id" v-if="!loadingData">
                                                <input
                                                    type="checkbox"
                                                    :value="perm.name"
                                                    :checked="Object.keys(rolePerms).some(o => rolePerms[o]['name'] === perm.name)"
                                                    v-model="this.form.permissions[perm.id]"
                                                    v-on:click="logit()"
                                                    v-on:input="perm.name = $event.target.value">
                                                {{ perm.name }}
                                            </label>
                                        </div>
                                        <jet-button type="submit">
                                            Сохранить
                                        </jet-button>
                                    </form>
                                    {{ result }}
                                </div>
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
import axios from "axios";
import JetButton from "@/Jetstream/Button";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    name: "RoleOne",
    components: {
        AdminLayout,
        JetButton,
    },
    setup () {
        const form = useForm({
            permissions: [],
            role: '',
        })

        return { form }
    },
    data() {
        return {
            roleData: {},
            rolePerms: {},
            allPerms: {},
            result: {},
            loadingData: true,
        }
    },
    created() {
        this.getAllPermissions();
        this.getRolePermissions();
        this.getRole();
    },
    props: ['permissions', 'debug'],
    methods: {
        getRole() {
            axios
                .get(route('api.admin.role.get', this.$page['props']['id']))
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.roleData = res.data;
                    this.form.role = res.data.name;
                    this.loadingData = false;
                });
        },
        getRolePermissions() {
            axios
                .get(route('api.admin.permission.role', this.$page['props']['id']))
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.rolePerms = res.data;
                    this.loadingData = false;
                });
        },
        getAllPermissions() {
            axios
                .get(route('api.admin.permission.all'))
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.allPerms = res.data;
                });
        },
        savePermissions() {
            this.form.post(route('api.admin.role.edit', this.roleData.id), {
                preserveScroll: true,
                onSuccess: () => console.log('success'),
            });
        },
        hasPermission(permission) {
            if (this.debug) console.log('permissions', this.permissions);

            return Object.keys(this.permissions).some(o => this.permissions[o]['name'] === permission);
        },
        logit() {
            console.log(this.form)
        }
    }
}
</script>

<style scoped>

</style>
