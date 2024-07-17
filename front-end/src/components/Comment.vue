<template>
    <div class="border-b border-blueGray-200">
        <p class="my-4 text-lg leading-relaxed text-blueGray-700" v-html="comment.content"></p>
        <div class="nested-comments" v-if="comment.replies && comment.replies.length">
            <reply v-for="reply in comment.replies" :key="reply.id" :reply="reply" />
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref, defineProps } from "vue";
    import Reply from '@/components/Reply.vue';

    const props = defineProps({
       comment: {
           type: Object,
           required: true
       }
    });
</script>

<style>
    .nested-comments {
        margin-left: 2em;
    }
</style>