<template>
    <div>
      <section>
        <div class="container mx-auto px-4">
          <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
            <div class="px-6">
              <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                </div>
              </div>
              <div class="text-left mt-10">
                <span class="text-sm text-blueGray-400" v-html="`Posted by: ${article.user_name}`"></span>
                <h3 class="text-3xl font-semibold leading-normal mb-2 text-left text-blueGray-700 mt-5" v-html="article.title"></h3>
                <div class="content mb-2 text-blueGray-600 mt-10" v-html="article.content"></div>
              </div>
              <font-awesome-icon :icon="['fas', 'coffee']" />
              <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                <div class="text-left">
                  <span class="text-sm text-blueGray-400" v-html="`${comments.length} Comments`"></span>
                  
                  <div class="w-full mt-3" v-for="comment in comments" :key="comment.id">
                    <span class="text-sm text-blueGray-400">Comment by {{ comment.user_name }}</span>
                    <Comments :comment="comment" />
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</template>

<script setup>
    import { onMounted, ref } from "vue";
    import { useRoute } from "vue-router";
    import axios from "@/libs/axios";
    import Comments from '@/components/Comment.vue';

    const { params: { slug: routeSlug } } = useRoute();

    const article = ref([]);
    const comments = ref([]);

    const fetchData = async() => {
        try {
            const response = await axios.get(`/article/${routeSlug}`);

            article.value = response.data;
            comments.value = response.data.comments;
        } catch (error) {
            console.error(error);
        }
    }

    onMounted(() => {
        fetchData();
    });
</script>

<style>
    .container {
        margin-top: 180px;
    }

    .content p {
        padding-bottom: 10px !important;
    }
</style>