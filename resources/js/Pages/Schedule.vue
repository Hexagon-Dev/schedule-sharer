<template>
    <app-layout title="Расписание">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Расписание
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <div class="flex justify-between bg-white items-center border-b border-gray-200">
                                        <div class="">
                                            <Link :href="route('schedule.add')" class="px-5 py-3 text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">Добавить</Link>
                                            <Link :href="route('schedule.delete')" class="px-5 py-3 text-base font-medium text-white bg-red-600 hover:bg-red-700">Удалить</Link>
                                        </div>
                                        <DayTab @click="changeDay(1)" :active="this.day === 1">Понедельник</DayTab>
                                        <DayTab @click="changeDay(2)" :active="this.day === 2">Вторник</DayTab>
                                        <DayTab @click="changeDay(3)" :active="this.day === 3">Среда</DayTab>
                                        <DayTab @click="changeDay(4)" :active="this.day === 4">Четверг</DayTab>
                                        <DayTab @click="changeDay(5)" :active="this.day === 5">Пятница</DayTab>
                                        <DayTab @click="changeDay(6)" :active="this.day === 6">Суббота</DayTab>
                                        <DayTab @click="changeDay(7)" :active="this.day === 7">Воскресенье</DayTab>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Предмет</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Преподаватель</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Аудитория</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Корпус</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Тип</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Начало</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Конец</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <transition-group name="fade-out-in">
                                        <tr v-for="schedule in data" :key="schedule['id']" v-if="!loadingData">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['lesson'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['teacher'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['classroom'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['building'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['type'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['start_time'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ schedule['end_time'] }}
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
import JetDayLink from '@/Jetstream/DayTab.vue'
import { Link } from '@inertiajs/inertia-vue3';
import DayTab from "../Jetstream/DayTab";
const axios = require('axios');

export default defineComponent({
    components: {
        DayTab,
        AppLayout,
        JetDayLink,
        Link,
    },
    data() {
        return {
            data: {},
            loadingData: true,
            day: "today"
        }
    },
    created() {
        let date = new Date();

        this.day = date.getDay();
        this.getSchedule();
    },
    methods: {
        changeDay(day) {
            this.day = day;
            this.loadingData = true;
            this.getSchedule(day);
        },
        getSchedule(weekday = null) {
            if (weekday === null) {
                let date = new Date();
                weekday = date.getDay();
            }

            axios
                .get(`/api/schedule/` + weekday)
                .then((res) => {
                    if (this.debug) console.log(res.data);
                    this.data = res.data;
                    this.loadingData = false;
                });
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
