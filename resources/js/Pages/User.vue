<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Пользователь
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="loadingData">Загрузка...</div>
                    <div v-if="!loadingData">
                        <h1 class="text-xl font-bold text-center">{{ data['name'] }}</h1>
                        <div class="flex flex-row mt-4 justify-center">
                            <div>
                                <img :src="data['profile_photo_url']" :alt="data['name']" class="object-cover" style="width: 180px; height: 180px;">
                            </div>
                            <div>
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ data['email'] }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Телефон</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Телеграм</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"> </dd>
                                    </div>
                                </dl>
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
const axios = require('axios');

export default defineComponent ({
    name: "User",
    components: {
        AppLayout,
    },
    data() {
        return {
            data: {},
            loadingData: true,
        }
    },
    created() {
        this.getSchedule();
    },
    methods: {
        getSchedule() {
            axios
                .get(`/api/user/` + this.$page['props']['user_id'])
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.data = res.data;
                    this.loadingData = false;
                });
        }
    }
})
</script>

<style scoped>

</style>
