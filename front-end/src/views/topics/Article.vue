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
                <router-link v-if="isLoggedIn && article.user?.id === user.id" :to="`/topics/aticle/${article.slug}/edit-article`" tag="div" class="edit-button mb-5 text-md text-blueGray-400 cursor-pointer">
                    <i class="fa fa-pencil-alt"></i>
                    Edit Article
                </router-link>
                <div class="flex justify-between">
                    <span class="text-sm text-blueGray-400">Posted {{ article.created_at }} by: {{ article.user?.name }}</span>
                    <div>
                        <div class="upVote"><i @click="vote('up')" class="fas fa-thumbs-up"></i>{{ article.votes_up }}</div>
                        <div class="downVote"><i @click="vote('down')" class="fas fa-thumbs-down"></i>{{ article.votes_down }}</div>
                    </div>
                </div>
                <h3 class="text-3xl font-semibold leading-normal mb-2 text-left text-blueGray-700 mt-5">{{ article.title }}</h3>
                <div class="content mb-2 text-blueGray-600 mt-10" v-html="article.content"></div>
              </div>
              <div 
                v-if="isLoggedIn"
                class="py-10 border-t border-blueGray-200 text-start">
                <form>
                    <p class="text-sm text-blueGray-400 mb-5">Comment:</p>
                    <input 
                        type="text" 
                        v-model="form.comment"
                        placeholder="Add a comment" 
                        class="border-0 px-2 py-2 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                    />
                    <button 
                        class="bg-emerald-500 mt-5 active:bg-emerald-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" 
                        type="button"
                        v-on:click="submitNewComment()"
                        :disabled="v$.$invalid"
                        >Submit
                    </button>
                </form>
              </div>
              <div class="py-5 border-t border-blueGray-200 text-center">
                <div class="text-left">
                  <span class="text-sm text-blueGray-400">{{ comments.length }} Comments</span>
                  <div class="w-full mt-3" v-for="comment in comments" :key="comment.id">
                    <span class="text-sm text-blueGray-400">Comment by {{ comment.user_name }}: {{ comment.created_at }}</span>
                    <Comments 
                        :comment="comment" 
                        :user="user" 
                        @update-comment="updateComment"
                        @update-reply="updateReply"
                     />
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
    import { onMounted, ref, computed, inject } from "vue";
    import { useRoute } from "vue-router";
    import axios from "@/libs/axios";
    import Comments from '@/components/Comment.vue';
    import useVuelidate from "@vuelidate/core";
    import { required, email } from "@vuelidate/validators";
    import { useGlobalState } from '@/libs/state';

    const { params: { slug: routeSlug } } = useRoute();

    const { loggedIn } = useGlobalState();

    const isLoggedIn = computed(() => loggedIn.value);

    const article = ref([]);
    const comments = ref([]);
    const user = ref({});

    const form = ref({
        comment: ""
    });

    const rules = computed(() => ({
        comment: { required },
    }));

    const v$ = useVuelidate(rules, form);

    const Swal = inject("$swal");

    const submitNewComment = async() => {
        if (v$.value.$invalid) {
            v$.value.$touch();
            return;
        }

        try {
            const { status, data } = await axios.post(`/comments`, {
                content: form.value.comment,
                article_id: article.value.id
            });

            if (status === 201) {
                comments.value.unshift(...data.comment);
                form.value.comment = "";
                console.log(comments.value);
            }
        } catch (error) {
            console.error(error);
        }
    }

    const updateComment = (comment, commentId) => {
        comments.value.find(item => {
            if (item.id === commentId) {
                item.content = comment;
            }
        });
    }

    const updateReply = (replyId, content) => {
        comments.value.forEach(comment => {
           comment.replies.find(reply => {
               if (reply.id === replyId) {
                   reply.content = content;
               }
           });
        });
    }

    const vote = async(type) => {
        try {
            const { status, data } = await axios.post(`/votes`, {
                article_id: article.value.id,
                vote: type
            });

            if (status === 200) {
                article.value.votes_up = data.votes.up
                article.value.votes_down = data.votes.down
            }
        } catch (error) {
            console.error(error);
        }
    }

    const fetchData = async() => {
        try {
            const response = await axios.get(`/article/${routeSlug}`);

            user.value = response.data.user;
            article.value = response.data.article;
            comments.value = response.data.article.comments;
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
        padding-bottom: 20px !important;
    }

    .upVote {
        margin-right: 20px;
    }

    .upVote,
    .downVote {
        cursor: pointer;
        float: left;
    }

    .upVote i,
    .downVote i {
        padding-right: 10px;
    }

    .create-new {
        z-index: 100;    
    }

    .edit-button:hover,
    .create-new:hover {
        text-decoration: underline;
    }
</style>