<template>
    <app-layout title="Новости">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Новости
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-for="post in postsData" :key="post['id']" class="p-6 mb-4 bg-white overflow-hidden shadow-xl sm:rounded-lg text-center">
                    <h2 class="mb-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900">{{ post['title'] }}</h2>
                    <p>{{ post['description'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ post['date_time'] }}</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import axios from "axios";

    export default defineComponent({
        components: {
            AppLayout,
        },
        created() {
            this.getPosts();
        },
        data() {
            return {
                postsData: {},
                loadingData: true,
            }
        },
        methods: {
            getPosts() {
                axios
                    .get(route('api.post.all'))
                    .then((res) => {
                        //console.log(res.data);
                        this.postsData = res.data;
                        this.loadingData = false;
                    });
            }
        }
    })
</script>
