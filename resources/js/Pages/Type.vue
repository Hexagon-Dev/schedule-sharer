<template>
    <app-layout title="Типы пар">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Типы расписаний
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <jet-form-section @submitted="createType">
                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="name" value="Название типа пары" />
                            <jet-input id="name" type="text" class="block w-full" v-model="form.name" ref="name" required />
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

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <transition-group name="fade-out-in">
                                            <tr v-for="type in data" :key="type['id']" v-if="!loadingData">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ type['id'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ type['name'] }}
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
        this.getTypes();
    },
    methods: {
        getTypes() {
            axios
                .get(`/api/type`)
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.data = res.data;
                    this.loadingData = false;
                });
        },
        createType() {
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
