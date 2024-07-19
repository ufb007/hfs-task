<template>
    <div>
        <p class="text-sm text-blueGray-400" v-html="`Replied by: ${reply.user_name} : ${reply.created_at}`"></p>
        <p class="replyToComment my-4 text-lg leading-relaxed text-blueGray-700 flex justify-between items-center">
            {{ reply.content }}
            <p v-if="isLoggedIn" class="replyToComment text-sm text-blueGray-400 cursor-pointer">
                <span @click="replyToComment(reply.user_name, reply.id)" class="replyToComment text-sm text-blueGray-400 cursor-pointer">Reply to comment</span>
                <span v-if="reply.user_id === user.id"> | </span> 
                <span @click="editReply(reply.id, reply.content)" class="replyToComment text-sm text-blueGray-400 cursor-pointer" v-if="reply.user_id === user.id">Edit</span>
                <span v-if="reply.user_id === user.id"> | </span> 
                <span @click="deleteReply(reply.id)" v-if="reply.user_id === user.id">Delete</span>
            </p>
        </p>

        <div class="nested-comments" v-if="reply.replies && reply.replies.length">
            <reply v-for="nestedReply in reply.replies" :key="nestedReply.id" :reply="nestedReply" :user="user" />
        </div>
    </div>
</template>

<script setup>
    import { defineProps, inject, computed, defineEmit } from "vue";
    import axios from "@/libs/axios";
    import { useGlobalState } from '@/libs/state';

    const { loggedIn } = useGlobalState();

    const props = defineProps({
       reply: {
            type: Object,
            required: true
       },
       user: {
            type: Object || null,
            required: true
       }
    });

    const isLoggedIn = computed(() => loggedIn.value);
    const emit = defineEmit(['update-reply']);

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

    const editReply = (replyId, content) => {
        Swal({
            inputLabel: 'Edit reply',
            input: 'text',
            showCancelButton: true,
            inputValue: content,
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

                const { status, data } = await axios.put(`/comments/${replyId}`, formData);

                if (status === 200) {
                    emit('update-reply', replyId, value.value);

                    Swal({
                        title: 'Success!',
                        text: 'Reply has been updated',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                }
            }
        })
    }

    const deleteReply = (replyId) => {
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
                axios.delete(`/comments/${replyId}`).then(() => {
                    Swal({
                        title: 'Success!',
                        text: 'Reply has been deleted',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        location.reload();
                    });
                });
            }
        })
    }
</script>