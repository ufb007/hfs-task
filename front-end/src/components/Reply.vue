<template>
    <div>
        <p class="text-sm text-blueGray-400" v-html="`Replied by: ${reply.user_name}`"></p>
        <p class="my-4 text-lg leading-relaxed text-blueGray-700 flex justify-between items-center">
            {{ reply.content }}
            <span @click="replyToComment(reply.user_name, reply.id)" class="replyToComment text-sm text-blueGray-400 cursor-pointer">Reply to comment</span>
        </p>

        <div class="nested-comments" v-if="reply.replies && reply.replies.length">
            <reply v-for="nestedReply in reply.replies" :key="nestedReply.id" :reply="nestedReply" />
        </div>
    </div>
</template>

<script setup>
    import { defineProps, inject } from "vue";
    import axios from "@/libs/axios";

    const props = defineProps({
       reply: {
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
</script>