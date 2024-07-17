<template>
    <div class="border-b border-blueGray-200">
        <div class="flex items-center justify-between">
            <p class="my-4 text-lg leading-relaxed text-blueGray-700" v-html="comment.content"></p>
            <p v-if="loggedIn" class="replyToComment text-sm text-blueGray-400 cursor-pointer">
                Reply to comment
                <!-- <span> | Edit</span> -->
            </p>
        </div>
        <div class="nested-comments" v-if="comment.replies && comment.replies.length">
            <reply v-for="reply in comment.replies" :key="reply.id" :reply="reply" />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref, defineProps } from "vue";  
    import Reply from '@/components/Reply.vue';

    const loggedIn = ref(false);

    const props = defineProps({
       comment: {
           type: Object,
           required: true
       }
    });

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