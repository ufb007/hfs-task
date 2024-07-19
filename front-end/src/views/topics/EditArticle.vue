<template>
    <div>
        <h3 class="z-100 text-2xl text-white relative mb-5">Edit article</h3>
        <div class="relative flex flex-col min-w-0 break-words w-full shadow-lg bg-white">
            <div class="block w-full overflow-x-auto">
                <form @submit.prevent="submit()">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th class="px-6 align-middle border border-solid py-3 text-xs border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 overflow-hidden">
                                    <p class="mb-3">Enter Title:</p>
                                    <input
                                        type="text"
                                        name="title"
                                        class="border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        v-model="form.title"
                                    />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="category border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-start flex-col">
                                    <p>Enter Content:</p>
                                    <textarea
                                        name="content"
                                        v-model="form.content"
                                        class="mt-2 border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                        style="height: 300px;"
                                    ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="category border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-start flex-col">
                                    <button
                                    class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none ease-linear transition-all duration-150"
                                    type="button"
                                    v-on:click="submit()"
                                    :disabled="v$.$invalid"
                                    >
                                    Update Article
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
    import axios from '@/libs/axios';
    import { computed, ref, onMounted } from "vue";
    import useVuelidate from "@vuelidate/core";
    import { required } from "@vuelidate/validators";
    import { useRoute } from "vue-router";

    const { params: { slug: routeSlug } } = useRoute();

    const form = ref({
        title: "",
        content: "",
    });

    const rules = computed(() => ({
        title: { required },
        content: { required },
    }));

    const article = ref({});

    const v$ = useVuelidate(rules, form);

    const fetchData = async() => {
        try {
            const { status, data } = await axios.get(`/article/${routeSlug}`);

            if (status === 200) {
                article.value = data.article;
                form.value.title = data.article.title;
                form.value.content = data.article.content.replace(/<\/?[^>]+(>|$)/g, "\n").trim();
            }
        } catch (error) {
            console.error(error);
        }
    }

    const formatContent = () => {
        return form.value.content.split('\n').map((item) => `<p>${item}</p>`).join('').replace(/<p><\/p>/g, '');
    }

    const submit = async () => {
        if (v$.value.$invalid) {
            v$.value.$touch();
            return;
        }

        try {
            const formData = { 
                title: form.value.title,
                content: formatContent()
            }

            const { status,data } = await axios.put(`/articles/${article.value.id}`, formData);

            if (status === 200) {
                window.location.href = `/topics/article/${article.value.slug}`;
            }
        } catch (error) {
            console.error(error);
        }
    }

    onMounted(() => {
        fetchData();
    });
</script>