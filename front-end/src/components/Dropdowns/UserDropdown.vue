<template>
  <div>
    <a
      class="text-blueGray-500 block"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)">
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
        >
          <img
            alt="..."
            class="w-full rounded-full align-middle border-none shadow-lg"
            :src="image"
          />
        </span>
      </div>
    </a>
    <div
      ref="popoverDropdownRef"
      class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }">
      <div v-if="!isLoggedIn">
        <router-link
          to="/auth/login"
          class="cursor-pointer text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
          Login
        </router-link>
        <router-link
          to="/auth/register"
          class="cursor-pointer text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
          Register
        </router-link>
      </div>

      <div v-if="loggedIn">
        <router-link
          to="/user/profile"
          class="cursor-pointer text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
          Profile
        </router-link>
        <div class="h-0 my-2 border border-solid border-blueGray-100" />
        <a
          @click="logout()"
          class="cursor-pointer text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
          Logout
      </a>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { createPopper } from "@popperjs/core";
  import { ref, getCurrentInstance, computed } from "vue";
  import axios from "@/libs/axios";
  import { useGlobalState } from '@/libs/state';

  import image from "@/assets/img/ph_user-circle-fill.jpg";

  const { loggedIn, setLoggedIn } = useGlobalState();

  const isLoggedIn = computed(() => loggedIn.value);

  const dropdownPopoverShow = ref(false);
  const popoverDropdownRef = ref(false);
  const btnDropdownRef = ref(false);

  const toggleDropdown = (event) => {
    event.preventDefault();

    if (dropdownPopoverShow.value) {
      dropdownPopoverShow.value = false;
    } else {
      dropdownPopoverShow.value = true;
      
      createPopper(btnDropdownRef.value, popoverDropdownRef.value, {
        placement: "bottom-start",
      });
    }
  }

  const logout = async () => {
    const { status } = await axios.post("/users/logout");

    if (status === 200) {
      sessionStorage.removeItem('token');

      setLoggedIn();
    }
  }
</script>
