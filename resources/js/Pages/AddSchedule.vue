<template>
    <app-layout title="Расписание">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Добавить расписание
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <jet-form-section @submitted="createSchedule">
                        <template #title>
                            Добавить расписание
                        </template>

                        <template #description>
                            Заполните все поля.
                        </template>

                        <template #form>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="lesson_id" value="Предмет" />
                                <select name="lesson_id" id="lesson_id" v-model="form.lesson_id" ref="lesson_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                    <option v-for="option in lessonsData" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="teacher_id" value="Преподаватель" />
                                <select name="teacher_id" id="teacher_id" v-model="form.teacher_id" ref="teacher_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                    <option v-for="option in teachersData" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="type_id" value="Тип" />
                                <select name="type_id" id="type_id" v-model="form.type_id" ref="type_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                    <option v-for="option in typesData" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="day" value="День недели" />
                                <select name="day" id="day" v-model="form.day" ref="day" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                    <option value="1">Понедельник</option>
                                    <option value="2">Вторник</option>
                                    <option value="3">Среда</option>
                                    <option value="4">Четверг</option>
                                    <option value="5">Пятница</option>
                                    <option value="6">Суббота</option>
                                    <option value="7">Воскресенье</option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="week_num" value="Порядок пар" />
                                <select autocomplete="off" name="week_num" id="week_num" v-model="form.week_num" ref="week_num" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full" required>
                                    <option value="0" selected>Еженедельно</option>
                                    <option value="1">Числитель</option>
                                    <option value="2">Знаменатель</option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="classroom" value="Аудитория" />
                                <jet-input id="classroom" type="text" class="block w-full" v-model="form.classroom" ref="classroom" required />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="building" value="Корпус" />
                                <jet-input id="building" type="text" class="block w-full" v-model="form.building" ref="building" required />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="start_time" value="Начало" />
                                <jet-input id="start_time" type="text" class="block w-full" v-model="form.start_time" ref="start_time" list="time-list1" required />
                                <datalist id="time-list1">
                                    <option value="08:00" />
                                    <option value="09:35" />
                                    <option value="11:25" />
                                    <option value="12:55" />
                                </datalist>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="end_time" value="Конец" />
                                <jet-input id="end_time" type="text" class="block w-full" v-model="form.end_time" ref="end_time" list="time-list2" required />
                                <datalist id="time-list2">
                                    <option value="09:20" />
                                    <option value="10:55" />
                                    <option value="12:45" />
                                    <option value="14:15" />
                                </datalist>
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
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";
    import JetActionMessage from "@/Jetstream/ActionMessage";
    import JetButton from "@/Jetstream/Button";

    const axios = require('axios');

    export default defineComponent({
        name: "AddSchedule",
        components: {
            AppLayout,
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
                    lesson_id: '',
                    teacher_id: '',
                    classroom: '',
                    building: '',
                    type_id: '',
                    start_time: '',
                    end_time: '',
                    day: '',
                    week_num: '',
                }),
                lessonsData: {},
                teachersData: {},
                typesData: {},
            }
        },
        created() {
            this.getLessonsList();
            this.getTeachersList();
            this.getTypesList();
        },
        methods: {
            createSchedule() {
                this.form.put(route('api.schedule.add'), {
                    errorBag: 'createSchedule',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        console.log('error');
                    }
                })
            },
            getLessonsList() {
                axios
                    .get(route('api.lesson.all'))
                    .then((res) => {
                        console.log(res.data);
                        this.lessonsData = res.data;
                    });
            },
            getTeachersList() {
                axios
                    .get(route('api.user.group.all', 'teacher'))
                    .then((res) => {
                        console.log(res.data);
                        this.teachersData = res.data;
                    });
            },
            getTypesList() {
                axios
                    .get(route('api.type.all'))
                    .then((res) => {
                        console.log(res.data);
                        this.typesData = res.data;
                    });
            },
        },
    })
</script>

<style scoped>

</style>
