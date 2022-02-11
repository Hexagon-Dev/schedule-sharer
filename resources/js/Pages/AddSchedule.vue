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
                                <jet-label for="lesson" value="Предмет" />
                                <select name="lesson" id="lesson" v-model="form.lesson" ref="lesson" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full">
                                    <option v-for="option in lessonsData" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="teacher" value="Преподаватель" />
                                <select name="teacher" id="teacher" v-model="form.teacher" ref="teacher" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block w-full">
                                    <option v-for="option in teachersData" v-bind:value="option.id">
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="classroom" value="Аудитория" />
                                <jet-input id="classroom" type="text" class="block w-full" v-model="form.classroom" ref="classroom" />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="building" value="Корпус" />
                                <jet-input id="building" type="text" class="block w-full" v-model="form.building" ref="building" />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="type" value="Тип" />
                                <jet-input id="type" type="text" class="block w-full" v-model="form.type" ref="type" />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="start_time" value="Начало" />
                                <jet-input id="start_time" type="time" class="block w-full" v-model="form.start_time" ref="start_time" />
                                <jet-input-error :message="form.error" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="end_time" value="Конец" />
                                <jet-input id="end_time" type="time" class="block w-full" v-model="form.end_time" ref="end_time" />
                                <jet-input-error :message="form.error" class="mt-2" />
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
                    lesson: '',
                    teacher: '',
                    classroom: '',
                    building: '',
                    type: '',
                    start_time: '',
                    end_time: '',
                }),
                lessonsData: {},
                teachersData: {},
            }
        },
        created() {
            this.getLessonsList();
        },
        methods: {
            createSchedule() {
                this.form.put(route(''), {
                    errorBag: 'updatePassword',
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset('password', 'password_confirmation')
                            this.$refs.password.focus()
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset('current_password')
                            this.$refs.current_password.focus()
                        }
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
                    .get(route('api.user.group.all'))
                    .then((res) => {
                        console.log(res.data);
                        this.teachersData = res.data;
                    });
            },
        },
    })
</script>

<style scoped>

</style>
