<template>
  <div class="flex flex-wrap mt-4">
    <div class="w-full mb-12 px-4">
      <div v-for="topic in topics" :key="topic.id">
        <card-table :categories="topic.categories" :title="topic.name" />
      </div>
    </div>
  </div>
</template>
<script setup>
  import CardTable from "@/components/Cards/CardTable.vue";
  import { onMounted, ref } from "vue";
  import axios from "@/libs/axios";

  const topics = ref([]);

  const fetchData = async () => {
    try {
      const response = await axios.get("/topics");
      topics.value = response.data;
    } catch (error) {
      console.error(error);
    }
  }

  onMounted(() => {
    fetchData();
  });
</script>
