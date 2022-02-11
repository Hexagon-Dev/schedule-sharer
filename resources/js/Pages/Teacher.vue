<template>
    <app-layout title="Преподаватели">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Преподаватели
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link :href="route('teacher.add')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">Добавить</Link>
                <Link :href="route('teacher.add')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Удалить</Link>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Почта</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <transition-group name="fade-out-in">
                                            <tr v-for="teacher in data" :key="teacher['id']" v-if="!loadingData">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ teacher['id'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ teacher['name'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ teacher['email'] }}
                                                </td>
                                            </tr>
                                            <tr v-if="loadingData">
                                                <td colspan="7">
                                                    <p class="text-center py-4">Загрузка...</p>
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
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3';
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
const axios = require('axios');

export default defineComponent({
    components: {
        AppLayout,
        Link,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
            }),
            data: {},
            loadingData: true,
        }
    },
    created() {
        this.getTeachers();
    },
    methods: {
        getTeachers() {
            axios
                .get(route('api.user.group', 'teacher'))
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.data = res.data;
                    this.loadingData = false;
                });
        },
        createTeacher() {
            this.form.put(route('api.type.create'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    console.log('error');
                }
            })
        },
    }
})
</script>

<style scoped>
.fade-out-in-enter-active,
.fade-out-in-leave-active {
    transition: opacity .2s;
}

.fade-out-in-enter-active {
    transition-delay: .2s;
}

.fade-out-in-enter,
.fade-out-in-leave-to {
    opacity: 0;
}
</style>
