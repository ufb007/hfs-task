<template>
  <div class="flex flex-wrap mt-4">
    <router-link tag="p" :to="`/topics/category/${id}/create-article`" class="create-new text-white pl-4 pb-4 cursor-pointer">Create new article</router-link>
    <div class="w-full mb-12 px-4">
        <card-articles :articles="category.articles" :title="category.name" />
    </div>
  </div>
</template>

<script setup>
    import { ref, onMounted } from "vue";
    import CardArticles from "@/components/Cards/CardArticles.vue";
    import axios from "@/libs/axios";
    import { useRoute } from "vue-router";

    const route = useRoute();
    const id = ref(route.params.id);

    const category = ref([]);

    const fetchData = async () => {
        try {
            const response = await axios.get(`/category/${id.value}`);
            console.log(response.data)
            category.value = response.data;
        } catch (error) {
            console.error(error);
        }
    }

    onMounted(() => {
        fetchData();
    })
</script>

<style scoped>
    .create-new {
        z-index: 100;    
    }

    .create-new:hover {
        text-decoration: underline;
    }
</style>