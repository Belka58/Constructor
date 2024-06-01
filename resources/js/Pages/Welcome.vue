<template>
    <Head title="Главная"/>
    <div class="min-h-screen max-sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto flex flex-col min-h-screen">
            <div class="p-3">
                <div class="flex justify-between items-center ">
                    <div>
                        <el-input
                            id="search"
                            autofocus
                            v-model="search"
                        />
                    </div>

                    <ApplicationLogo class="h-10 w-10 fill-white"/>

                    <el-button>
                        Конструктор
                    </el-button>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-5 grow mb-5">
                <el-tabs :disabled="isLoad" v-model="activeName" @tab-click="handleClick" stretch>
                    <el-tab-pane v-for="(item, index) in types" :label="item" :name="index">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-700 rounded-lg flex justify-between gap-3" v-for="post in items">
                                <div>
                                    {{ post.name }}
                                </div>
                                <svg @click="onDownload(post.id)" class="min-w-8 max-w-8 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </div>
                        </div>
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import {onMounted, Ref, ref} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import axios from "axios";
import _ from "lodash";

const search = ref('');
const activeName = ref('1');
const items = ref([]);
const isLoad = ref(true);

const handleClick = (tab) => {
    isLoad.value = true;
    fetch(tab.props.name);
}

const fetch = async (id: string | number | null = null) => {
    items.value = (await axios.get(`/work-program/${id ?? activeName.value}`)).data;
    isLoad.value = false;
}

const onDownload = async (id: number) => {
    console.log(id);
    // todo: зауярить скачивание
}

onMounted(fetch)

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    types: any;
}>();
</script>
