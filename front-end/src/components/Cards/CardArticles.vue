<template>
    <div class="relative flex flex-col min-w-0 break-words w-full shadow-lg bg-white">
      <div class="block w-full overflow-x-auto">
        <table class="items-center w-full bg-transparent border-collapse">
          <thead>
            <tr>
              <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50"
                v-html="title">
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="article in articles" :key="article.id">
              <td class="category border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center cursor-pointer justify-between">
                <span @click="router.push(`/topics/article/${article.slug}`)" class="ml-3 font-bold text-blueGray-600" v-html="`<span>${article.title}</span> - <span class='text-blueGray-400 ml-5'>By ${article.user?.name} - ${article.comments_count} Comments - ${article.votes} Votes</span>`"></span>
                <i v-if="loggedIn && user.id === article.user?.id" @click="deleteArticle(article.id)" class="fas fa-trash text-blueGray-400"></i>
              </td>
            </tr>
            <tr v-if="articles.length == 0">
                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center">
                    <span class="ml-3 font-bold text-blueGray-600">
                        <span>No Articles Posted</span>
                    </span>
                </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  <script setup>
    import { defineProps, inject } from "vue";
    import { useRouter } from "vue-router";
    import axios from "@/libs/axios";
    import { useGlobalState } from "@/libs/state";

    const { loggedIn } = useGlobalState();

    const router = useRouter();
  
    const props = defineProps({
      articles: {
        type: Array,
        required: true,
        default: () => []
      },
      title: {
        type: String
      },
      user: {
        type: Object || null,
        required: true
      }
    });

    const Swal = inject("$swal");

    const deleteArticle = (id) => {
      Swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/articles/${id}`).then(() => {
            location.reload();
          });
        }
      });
    }
  </script>
  
  <style scoped>
    .category:hover {
      background-color: #f5f5f5;
    }
  </style>
  