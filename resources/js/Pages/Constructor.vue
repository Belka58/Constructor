<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ editData }}
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

const editData = ref({
    curse: '',
    header: '',
    orgRazrab: '',
    razrabi: [],
    rechesents: [],
    specialnost: '',
    workProgramName: '',
    table: {
        attectacia: '',
        compotensy: '',
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
});

onMounted(async () => {
    const wkid = route().params.wk_id;
    if (wkid) {
        editData.value = (await axios.get(`/work-program/wk/${wkid}`)).data.content;
    }

});
</script>
