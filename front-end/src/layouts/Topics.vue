<template>
    <div>
      <div class="relative bg-blueGray-100">
        <admin-navbar />
        <header-stats />
        <div class="px-4 md:px-10 mx-auto w-full -m-24">
          <router-view />
        </div>
      </div>
    </div>
  </template>
  <script setup>
    import AdminNavbar from "@/components/Navbars/AdminNavbar.vue";
    import HeaderStats from "@/components/Headers/HeaderStats.vue";
  </script>