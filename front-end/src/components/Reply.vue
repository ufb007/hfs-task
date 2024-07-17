<template>
    <div>
        <p class="text-sm text-blueGray-400" v-html="`Replied by: ${reply.user_name}`"></p>
        <p class="my-4 text-lg leading-relaxed text-blueGray-700" v-html="reply.content"></p>

        <div class="nested-comments" v-if="reply.replies && reply.replies.length">
            <reply v-for="nestedReply in reply.replies" :key="nestedReply.id" :reply="nestedReply" />
        </div>
    </div>
</template>

<script setup>
    import { defineProps } from "vue";

    const props = defineProps({
       reply: {
            type: Object,
            required: true
       } 
    });
</script>