<template>
    <div class="border-b border-blueGray-200">
        <div class="flex items-center justify-between">
            <p class="my-4 text-lg leading-relaxed text-blueGray-700" v-html="comment.content"></p>
            <p v-if="loggedIn" class="replyToComment text-sm text-blueGray-400 cursor-pointer">
                <span @click="replyToComment(comment.user_name, comment.id)" class="hover:underline">Reply to comment</span>
                <!-- <span> | Edit</span> -->
            </p>
        </div>
        <div class="nested-comments" v-if="comment.replies && comment.replies.length">
            <reply v-for="reply in comment.replies" :key="reply.id" :reply="reply" />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref, defineProps, inject } from "vue";  
    import Reply from '@/components/Reply.vue';
    import axios from "@/libs/axios";

    const loggedIn = ref(false);

    const props = defineProps({
       comment: {
           type: Object,
           required: true
       }
    });

    const Swal = inject("$swal");

    const replyToComment = async (userName, commentId) => {
        Swal({
            inputLabel: `Reply to ${userName}`,
            input: 'text',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Field is empty!';
                }
                return null;
            }
        }).then(async (value) => {
            if (value.isConfirmed) {
                const formData = {
                    content: value.value,
                    parent_id: commentId
                }

                const { status, data } = await axios.post(`/comments`, formData);

                if (status === 201) {
                    Swal({
                        title: 'Success!',
                        text: 'Reply has been posted',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        location.reload();
                    });
                }
            }
        })
    }

    onMounted(() => {
        if (sessionStorage.getItem('token')) {
            loggedIn.value = true;
        }
    });
</script>

<style>
    .nested-comments {
        margin-left: 2em;
    }

    .replyToComment:hover {
        text-decoration: underline;
    }
</style>