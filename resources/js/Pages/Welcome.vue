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

                    <ApplicationLogo @click="onRoute(route('dashboard'))" class="h-10 w-10 fill-white"/>

                    <el-button @click="onRoute(route('constructor'))">
                        Конструктор
                    </el-button>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg p-5 grow mb-5">
                <el-tabs :disabled="isLoad" v-model="activeName" @tab-click="handleClick" stretch>
                    <el-tab-pane v-for="(item, index) in types" :label="item" :name="index">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-700 rounded-lg flex justify-between gap-3" v-for="post in filteredItems">
                                <div>
                                    {{ post.name }}
                                </div>
                                <el-dropdown class="h-fit focus-visible:*:outline-0 focus-visible:outline-0">
                                    <svg class="min-w-8 max-w-8 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" >
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                    </svg>
                                    <template #dropdown>
                                        <el-dropdown-menu>
                                            <el-dropdown-item @click="onDownload(post.id, 'word')">Word</el-dropdown-item>
                                            <el-dropdown-item @click="onDownload(post.id, 'pdf')">Pdf</el-dropdown-item>
                                        </el-dropdown-menu>
                                    </template>
                                </el-dropdown>

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
import {computed, onMounted, ref} from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import axios from "axios";

const search = ref('');
const activeName = ref('1');
const items = ref([]);
const isLoad = ref(true);

const filteredItems = computed(() => {
    return items.value.filter(item => item.name.toLowerCase().includes(search.value.toLowerCase()));
});

const handleClick = (tab: any) => {
    isLoad.value = true;
    fetch(tab.props.name);
}

const fetch = async (id: string | number | null = null) => {
    items.value = (await axios.get(`/work-program/${id ?? activeName.value}`)).data;
    isLoad.value = false;
}

const onDownload = (id: number, type: string) => {
    axios.get(`/work-program/${id}/download/${type}`, { responseType: 'blob' }).then(res => {
        const blob = new Blob([res.data], { type: res.headers['content-type'] });
        const downloadUrl = window.URL.createObjectURL(blob);
        const linkUrl = document.createElement('a');

        const name = items.value.find(x => x.id === id)?.name ?? id;
        const filename = `${name}.${type}`;

        linkUrl.href = downloadUrl;
        linkUrl.download = filename;
        document.body.appendChild(linkUrl);
        linkUrl.click();
        document.body.removeChild(linkUrl);
        window.URL.revokeObjectURL(downloadUrl);
    })
}

const onRoute = (href: string) => {
    location.href = href;
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
