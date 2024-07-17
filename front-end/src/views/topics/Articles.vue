<template>
  <div class="flex flex-wrap mt-4">
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