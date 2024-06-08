<template>
    <Head title="Конструктор"/>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form class="space-y-6 relative">
                            <div class="w-full">
                                <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Название
                                    рабочей программы на сайте</label>
                                <el-input v-model="fullContent.name" class="bg-gray-700"/>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-full">
                                    <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Название
                                        рабочей программы</label>
                                    <el-input v-model="fullContent.content.workProgramName" class="bg-gray-700"/>
                                </div>
                                <div class="w-full">
                                    <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Тип рабочий программы</label>
                                    <el-select v-model="fullContent.type" placeholder="Ничего не выбрано" class="bg-gray-700">
                                        <el-option v-for="(item, index) in types " :label="item" :value="index" />
                                    </el-select>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="w-full">
                                    <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Специальность</label>
                                    <el-input v-model="fullContent.content.specialnost" class="bg-gray-700"/>
                                </div>
                                <div class="w-full">
                                    <label
                                        class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Курс</label>
                                    <el-input v-model="fullContent.content.curse" class="bg-gray-700"/>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="w-full">
                                    <label
                                        class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Образовательное учреждение </label>
                                    <el-input v-model="fullContent.content.header" class="bg-gray-700"/>
                                </div>
                                <div class="w-full">
                                    <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Организация - разработчик</label>
                                    <el-input v-model="fullContent.content.orgRazrab" class="bg-gray-700"/>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300 ">Разработчики</label>
                                <div v-for="(developer, index) in fullContent.content.razrabi" :key="index"
                                     class="flex items-center space-x-2 ">
                                    <el-input v-model="fullContent.content.razrabi[index]" placeholder="Имя разработчика"
                                              class="bg-gray-700 mt-2"/>
                                    <el-button class="h-full mt-2" type="danger" @click="removeDeveloper(index)">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                    </el-button>
                                </div>
                                <el-button type="primary" class="mt-3" @click="addDeveloper">Добавить разработчика
                                </el-button>
                            </div>
                            <div>
                                <label
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300 ">Рецензенты</label>
                                <div v-for="(reviewer, index) in fullContent.content.rechesents" :key="index"
                                     class="flex items-center space-x-2 ">
                                    <el-input v-model="fullContent.content.rechesents[index]" placeholder="Имя рецензента"
                                              class="bg-gray-700 mt-2"/>
                                    <el-button class="h-full mt-2" type="danger" @click="removeReviewer(index)">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                    </el-button>
                                </div>
                                <el-button type="primary" class="mt-3" @click="addReviewer">Добавить рецензента
                                </el-button>
                            </div>
                            <div>
                                <label class="block text-2xl font-medium text-gray-700 dark:text-gray-300 mb-2">Таблица</label>
                                <div class="flex gap-3">
                                    <div class="w-full">
                                        <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Аттестация (ч)</label>
                                        <el-input v-model="fullContent.content.table.attectacia" class="bg-gray-700"/>
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Консультации (ч)</label>
                                        <el-input v-model="fullContent.content.table.insult" class="bg-gray-700"/>
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Решение задач (ч)</label>
                                        <el-input v-model="fullContent.content.table.reshenie_zadas" class="bg-gray-700"/>
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Отчет (ч)</label>
                                        <el-input v-model="fullContent.content.table.otchet" class="bg-gray-700"/>
                                    </div>
                                    <div class="w-full">
                                        <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Самостоятельно (ч)</label>
                                        <el-input v-model="fullContent.content.table.samostoylka" class="bg-gray-700"/>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Компетенции</label>
                                <el-input v-model="fullContent.content.table.compotensy" class="bg-gray-700"/>
                            </div>
                            <div>
                                <label
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Разделы</label>
                                <div v-for="(section, sectionIndex) in fullContent.content.table.razdels" :key="sectionIndex"
                                     class="space-y-4 mb-8">
                                    <div class="flex space-x-2">
                                        <div class="w-full flex items-center gap-2">
                                            <span>{{ sectionIndex + 1 }}. </span>
                                            <el-input v-model="section.name" placeholder="Название раздела"
                                                      class="bg-gray-700"/>
                                        </div>
                                        <el-button type="danger" @click="removeSection(sectionIndex)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                        </el-button>
                                        <el-button type="primary" @click="addTheme(sectionIndex)">Добавить тему
                                        </el-button>
                                    </div>
                                    <div v-for="(theme, themeIndex) in section.themes" :key="themeIndex"
                                         class="space-y-4 pl-8">
                                        <div class="flex space-x-2">
                                            <div class="w-full flex items-center gap-2">
                                                <span>{{ themeIndex + 1 }}. </span>
                                                <el-input v-model="theme.name" placeholder="Название темы"
                                                          class="bg-gray-700"/>
                                            </div>

                                            <el-button class="h-full" type="danger"
                                                       @click="removeTheme(sectionIndex, themeIndex)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                            </el-button>
                                            <el-button type="primary" @click="addLesson(sectionIndex, themeIndex)">
                                                Добавить лекцию
                                            </el-button>
                                            <el-button type="primary" @click="addPractika(sectionIndex, themeIndex)">
                                                Добавить лабораторную
                                            </el-button>
                                        </div>
                                        <div class="pl-16">
                                            <div class="space-y-2">
                                                <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Лекции</label>
                                                <div v-for="(lesson, lessonIndex) in theme.lessons" :key="lessonIndex"
                                                     class="flex space-x-2">
                                                        <span>{{ lessonIndex + 1 }}. </span>
                                                    <el-input v-model="lesson.name" placeholder="Название лекции"
                                                              class="bg-gray-700"/>
                                                    <el-input v-model="lesson.hours" placeholder="Часы"
                                                              class="bg-gray-700"/>
                                                    <el-input v-model="lesson.osvoen" placeholder="Освоено"
                                                              class="bg-gray-700"/>
                                                    <el-button class="h-full" type="danger"
                                                               @click="removeLesson(sectionIndex, themeIndex, lessonIndex)">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                                    </el-button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-16">
                                            <div class="space-y-2">
                                                <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Лабораторные работы</label>
                                                <div v-for="(practika, practikaIndex) in theme.practika"
                                                     :key="practikaIndex" class="flex space-x-2">
                                                    <span>{{ practikaIndex + 1 }}. </span>
                                                    <el-input v-model="practika.name" placeholder="Название лабораторной"
                                                              class="bg-gray-700"/>
                                                    <el-input v-model="practika.hours" placeholder="Часы"
                                                              class="bg-gray-700"/>
                                                    <el-button class="h-full" type="danger"
                                                               @click="removePractika(sectionIndex, themeIndex, practikaIndex)">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"> <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /> </svg>
                                                    </el-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <el-button class="block" type="primary" @click="addSection">Добавить раздел</el-button>
                            </div>
                           <div class="flex justify-end">
                               <el-button  type="primary" @click="onSubmit">
                                   Сохранить
                               </el-button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import axios from "axios";
import {
    ElInput,
    ElButton
} from 'element-plus';
import 'element-plus/theme-chalk/index.css';

const onSubmit = async () => {
    if (isEdit.value) {
        await axios.patch(`/work-program/${fullContent.value.id}`, fullContent.value)
    } else  {
        await axios.post(`/work-program`, fullContent.value)
    }
    location.href = '/dashboard'
}

const isEdit = ref(false);
const types = ref([]);
const fullContent = ref({
    name: '',
    type: '1',
    publish: 0,
    content: {
        curse: '',
        header: '',
        orgRazrab: '',
        razrabi: [''],
        rechesents: [''],
        specialnost: '',
        workProgramName: '',
        table: {
            reshenie_zadas: '',
            attectacia: '',
            compotensy: '',
            samostoylka:'',
            insult: '',
            otchet: '',
            razdels: [
                {
                    name: '',
                    themes: [
                        {
                            name: '',
                            lessons: [
                                {
                                    hours: '',
                                    name: '',
                                    osvoen: '',
                                }
                            ],
                            practika: [
                                {
                                    hours: '',
                                    name: '',
                                }
                            ]
                        }
                    ]
                }
            ],
        }
    }
});

onMounted(async () => {
    const wkid = route().params.wk_id;
    if (wkid) {
        isEdit.value = true;
        fullContent.value = (await axios.get(`/work-program/wk/${wkid}`)).data;
        fullContent.value.type = fullContent.value.type.toString();
    }

    types.value = (await axios.get('/types')).data;
});

function addDeveloper() {
    fullContent.value.content.razrabi.push('');
}

function removeDeveloper(index: number) {
    fullContent.value.content.razrabi.splice(index, 1);
}

function addReviewer() {
    fullContent.value.content.rechesents.push('');
}

function removeReviewer(index: number) {
    fullContent.value.content.rechesents.splice(index, 1);
}

function addSection() {
    fullContent.value.content.table.razdels.push({
        name: '',
        themes: [{
            name: '',
            lessons: [{hours: '', name: '', osvoen: ''}],
            practika: [{hours: '', name: ''}]
        }]
    });
}

function removeSection(sectionIndex: number) {
    fullContent.value.content.table.razdels.splice(sectionIndex, 1);
}

function addTheme(sectionIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes.push({
        name: '',
        lessons: [{hours: '', name: '', osvoen: ''}],
        practika: [{hours: '', name: ''}]
    });
}

function removeTheme(sectionIndex: number, themeIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes.splice(themeIndex, 1);
}

function addLesson(sectionIndex: number, themeIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes[themeIndex].lessons.push({
        hours: '',
        name: '',
        osvoen: ''
    });
}

function removeLesson(sectionIndex: number, themeIndex: number, lessonIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes[themeIndex].lessons.splice(lessonIndex, 1);
}

function addPractika(sectionIndex: number, themeIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes[themeIndex].practika.push({
        hours: '',
        name: ''
    });
}

function removePractika(sectionIndex: number, themeIndex: number, practikaIndex: number) {
    fullContent.value.content.table.razdels[sectionIndex].themes[themeIndex].practika.splice(practikaIndex, 1);
}
</script>
