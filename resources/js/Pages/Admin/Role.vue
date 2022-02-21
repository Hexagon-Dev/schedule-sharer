<template>
    <admin-layout title="Роли">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Роли
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg mt-4">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" class="py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роль</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" v-if="hasPermission('lesson_create')">
                                <transition-group name="fade-out-in">
                                    <tr v-for="role in data" :key="role.id" v-if="!loadingData" class="cursor-pointer hover:bg-gray-200 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap" v-on:click="openRole(role.id)">
                                            {{ role.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap" v-on:click="openRole(role.id)">
                                            {{ role.name }}
                                        </td>
                                    </tr>
                                </transition-group>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </admin-layout>
</template>

<script>
import axios from "axios";
import AdminLayout from "@/Layouts/AdminLayout";

export default {
    name: "Role",
    components: {
        AdminLayout,
    },
    data() {
        return {
            data: {},
            loadingData: true,
        }
    },
    created() {
        this.getRoles();
    },
    props: ['permissions', 'debug'],
    methods: {
        getRoles() {
            axios
                .get(route('api.admin.role.all'))
                .then((res) => {
                    console.log(res.data);
                    this.data = res.data;
                    this.loadingData = false;
                });
        },
        hasPermission(permission) {
            if (this.debug) console.log('permissions', this.permissions);

            return Object.keys(this.permissions).some(o => this.permissions[o]['name'] === permission);
        },
        openRole(role_id) {
            this.$inertia.visit(route('admin.role.one', role_id));
        }
    }
}
</script>

<style scoped>

</style>
