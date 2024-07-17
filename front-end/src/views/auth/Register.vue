<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-6/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0"
        >
          <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
              <h6 class="text-blueGray-500 text-sm font-bold">
                Sign Up
              </h6>
            </div>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form @submit.prevent="submit()">
              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Name
                </label>
                <input
                  type="email"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Name"
                  v-model="form.name"
                />
                <span class="text-red-500 text-sm" v-if="v$.name.required.$invalid">Name is required</span>
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Email
                </label>
                <input
                  type="email"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Email"
                  v-model="form.email"
                />
                <span class="text-red-500 text-sm" v-if="v$.email.required.$invalid">Email is required</span>
                <span class="text-red-500 text-sm" v-if="v$.email.email.$invalid">Email must be valid</span>
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Password
                </label>
                <input
                  type="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  v-model="form.password"
                />
                <span class="text-red-500 text-sm" v-if="v$.password.required.$invalid">Password is required</span>
                <span class="text-red-500 text-sm" v-if="v$.password.minLength.$invalid">Password must have 8 characters or more</span>
              </div>

              <div class="relative w-full mb-3">
                <label
                  class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                  htmlFor="grid-password"
                >
                  Confirm Password
                </label>
                <input
                  type="password"
                  class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                  placeholder="Password"
                  v-model="form.password_confirmation"
                />

                <span class="text-red-500 text-sm" v-if="v$.password_confirmation.required.$invalid">Password Confirmation is required<br /></span>
                <span class="text-red-500 text-sm" v-if="v$.password_confirmation.passwordsMatch.$invalid">Passwords do not match!</span>
              </div>

              <div class="text-center mt-6">
                <button
                  class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                  type="button"
                  @click="submit()"
                  :disabled="v$.$invalid"
                >
                  Create Account
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
  import { computed } from "@vue/reactivity";
  import { ref } from "vue";
  import axios from "@/libs/axios";
  import useVuelidate from "@vuelidate/core";
  import { required, email } from "@vuelidate/validators";

  const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const rules = computed(() => ({
    name: { required },
    email: { required, email },
    password: { required, minLength: 8 },
    password_confirmation: { 
      required,
      passwordsMatch: (value) => value === form.value.password
    },
  }));

  const v$ = useVuelidate(rules, form);

  const submit = async () => {
    if (v$.value.$invalid) {
      v$.value.$touch();
      return;
    }

    try {
      const { status, data } = await axios.post("/users", form.value);
      
      if (status === 201) {
        sessionStorage.setItem('token', data.token);
        window.location.href = "/topics/categories";
      }
    } catch (error) {
      console.log(error.response.data.message);
    }
  }
</script>

<style scoped>
  button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
  }
</style>