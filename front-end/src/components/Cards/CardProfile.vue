<template>
  <div
    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0"
  >
    <div class="rounded-t bg-white mb-0 px-6 py-6">
      <div class="text-center flex justify-between">
        <h6 class="text-blueGray-700 text-xl font-bold">My Profile</h6>
      </div>
    </div>
    <div class="flex-auto px-4 lg:px-10 py-10 pt-10">
      <form>
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="grid-password">
                Name
              </label>
              <input
                type="text"
                v-model="form.name"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
              />
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="grid-password">
                Email address
              </label>
              <input
                type="email"
                v-model="form.email"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
              />
              <span class="text-red-500 text-sm" v-if="v$.email.email.$invalid">Email must be valid</span>
            </div>
          </div>
          <div class="w-full lg:w-6/12 px-4">
            <div class="relative w-full mb-3">
              <label
                class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                htmlFor="grid-password">
                Password
              </label>
              <input
                type="password"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
              />
            </div>
          </div>
        </div>

        <button 
            class="bg-emerald-500 mt-5 active:bg-emerald-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" 
            type="button"
            v-on:click="submit()"
            :disabled="v$.$invalid"
            >Update
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
  import { defineProps, onMounted, ref, watch, inject, computed } from "vue";
  import axios from "@/libs/axios";
  import useVuelidate from "@vuelidate/core";
  import { email, minLength } from "@vuelidate/validators";

  const props = defineProps({
    user: {
      required: true,
    },
  });

  const Swal = inject("$swal");

  const form = ref({
    name: null,
    email: null,
    password: null,
  });

  const rules = computed(() => ({
    email: { email },
    password: { minLength: minLength(8) },
  }));

  const v$ = useVuelidate(rules, form);

  watch(() => props.user, (newUser) => {
      form.value.name = newUser?.name || null;
      form.value.email = newUser?.email || null;
    },
    { immediate: true }
  );

  const submit = async () => {
    if (v$.value.$invalid) {
      v$.value.$touch();
      return;
    }

    let formData = {};

    Object.keys(form.value).forEach((key) => {
      if (form.value[key] !== null) {
        formData[key] = form.value[key];
      }
    });

    try {
      const { status, data } = await axios.put(`/users/${props.user?.id}`, formData);

      if (status === 200) {
        Swal({
          title: 'Success!',
          text: 'Profile data has been updated',
          icon: 'success',
          confirmButtonText: 'OK',
        });
      }
    } catch (error) {
      console.log(error);
    }
  }
</script>