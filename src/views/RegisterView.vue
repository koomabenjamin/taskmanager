<template>
  <div class="min-h-screen flex items-center justify-center  bg-lime-50 bg-opacity-50">
    <div class="max-w-md w-full space-y-8 p-6 bg-lime-100 bg-opacity-50 rounded-lg shadow-md">
      <div class="text-center">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-2xl font-bold text-gray-900">Account Sign Up</h2>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="submitLoginData">
        <div class="rounded-md shadow-sm space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-900">Name:</label>
            <InputForm id="name" name="name" type="text" v-model="name" placeholder="Name" required />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-900">Email Address:</label>
            <InputForm id="email" name="email" type="email" v-model="email" placeholder="E-mail Address" required />
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-900">Password:</label>
            <InputForm id="password" name="password" type="password" v-model="password" placeholder="Password" required />
          </div>

          <div>
            <label for="confirm_password" class="block text-sm font-medium text-gray-900">Confirm Password:</label>
            <InputForm id="confirm_password" name="confirm_password" type="password" v-model="confirmpassword" placeholder="Confirm Password" required />
          </div>
        </div>

        <div>
          <Button type="submit" label="Sign Up" class="flex w-full justify-center bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" />
        </div>

        <p class="text-center text-sm text-gray-600">
          Have an Account?
          <a href="#" @click.prevent="goToLogin" class="font-semibold text-indigo-600 hover:text-indigo-500">Login</a>
        </p>
      </form>

      <!-- <p class="mt-4">Input Email: {{ email }}</p>
      <p>Input Password: {{ password }}</p> -->
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import Button from '../components/shared/Button.vue'
import InputForm from '../components/shared/Input.vue'

const name = ref('')
const email = ref('')
const password = ref('')
const confirmpassword = ref('')
const authStore = useAuthStore()
const router = useRouter()

const submitLoginData = async () => {
  console.log("Name: ", name.value)
  console.log("Email: ", email.value)
  console.log("Password: ", password.value)
  console.log("Confirm Password: ", confirmpassword.value)
  // try {
  //   await authStore.register(name.value, email.value, password.value, confirmpassword.value)
  //   router.push('/')
  // } catch (error) {
  //   alert('Sign Up failed')
  // }
}

const goToLogin = () => {
  router.push('/login')
}
</script>

<style scoped>
</style>
