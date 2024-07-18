<template>
    <div class="flex flex-wrap justify-items-center">
      <div class="w-full px-4">
        <CardProfile :user="user" />
      </div>
    </div>
</template>

<script setup>
    import CardProfile from "@/components/Cards/CardProfile.vue";
    import { onMounted, ref } from "vue";
    import axios from "@/libs/axios";

    const user = ref({});

    onMounted(async () => {
      const { status, data } = await axios.get("/user");

      if (status === 200) {
        console.log(data);
        user.value = data
      }
    });
</script>
  