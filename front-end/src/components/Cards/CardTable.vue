<template>
  <div class="relative flex flex-col min-w-0 break-words w-full shadow-lg bg-white">
    <div class="block w-full overflow-x-auto">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50">
              {{ title }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <th @click="router.push(`/topics/category/${category.id}/articles`)" class="category border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center cursor-pointer">
              <span class="ml-3 font-bold text-blueGray-600" v-html="`<span>${category.name}</span> - <span class='text-blueGray-400 ml-5'>${category.article_count} Articles</span>`"></span>
            </th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
  import { defineProps } from "vue";
  import { useRouter } from "vue-router";

  const router = useRouter();

  const props = defineProps({
    categories: {
      type: Array
    },
    title: {
      type: String
    }
  });
</script>

<style scoped>
  .category:hover {
    background-color: #f5f5f5;
  }
</style>
