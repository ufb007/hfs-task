<template>
    <div class="border-b border-blueGray-200">
        <div class="flex items-center justify-between">
            <p class="my-4 text-lg leading-relaxed text-blueGray-700" v-html="comment.content"></p>
            <p v-if="isLoggedIn" class="replyToComment text-sm text-blueGray-400 cursor-pointer">
                <span @click="replyToComment(comment.user_name, comment.id)" class="hover:underline">Reply to comment</span>
                <span v-if="comment.user_id === user.id"> | </span> 
                <span @click="editComment(comment.id, comment.content)" v-if="comment.user_id === user.id">Edit</span>
                <span v-if="comment.user_id === user.id"> | </span> 
                <span @click="deleteComment(comment.id)" v-if="comment.user_id === user.id">Delete</span>
            </p>
        </div>
        <div class="nested-comments" v-if="comment.replies && comment.replies.length">
            <reply v-for="reply in comment.replies" :key="reply.id" :reply="reply" :user="user" @update-reply="emitUpdateComment" />
        </div>
    </div>
</template>

<script setup>
    import { defineProps, inject, computed, defineEmit } from "vue";
    import Reply from '@/components/Reply.vue';
    import axios from "@/libs/axios";
    import { useGlobalState } from '@/libs/state';

    const { loggedIn } = useGlobalState();

    const props = defineProps({
       comment: {
           type: Object,
           required: true
       },   
       user: {
           type: Object || null,
           required: true
       }
    });

    const isLoggedIn = computed(() => loggedIn.value);
    const emit = defineEmit(['update-comment', 'update-reply']);

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

    const editComment = (commentId, comment) => {
        Swal({
            inputLabel: 'Edit comment',
            input: 'text',
            showCancelButton: true,
            inputValue: comment,
            inputValidator: (value) => {
                if (!value) {
                    return 'Field is empty!';
                }
                return null;
            }
        }).then(async (value) => {
            if (value.isConfirmed) {
                const formData = {
                    content: value.value
                }

                const { status, data } = await axios.put(`/comments/${commentId}`, formData);

                emit('update-comment', value.value, commentId);

                if (status === 200) {
                    Swal({
                        title: 'Success!',
                        text: 'Comment has been updated',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                }
            }
        });
    }

    const deleteComment = (commentId) => {
        Swal({
            title: 'Are you sure?',
            text: "This will be deleted forever!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/comments/${commentId}`).then(() => {
                    Swal({
                        title: 'Success!',
                        text: 'Comment has been deleted',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                });
            }
        })
    }

    const emitUpdateComment = (replyId, content) => {
        emit('update-reply', replyId, content);
    }
</script>

<style>
    .nested-comments {
        margin-left: 2em;
    }
</style>