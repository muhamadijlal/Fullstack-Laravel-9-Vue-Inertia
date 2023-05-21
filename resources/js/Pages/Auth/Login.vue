<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto space-y-6">
      <div class="mt-4">
        <label for="email" class="label">E-mail (username)</label>
        <input id="email" v-model="form.email" type="email" class="input" autocomplete="off" />
        <div v-if="form.errors.email" class="is-invalid">{{ form.errors.email }}</div>
      </div>
      <div>
        <label for="password" class="label">Password</label>
        <input id="password" v-model="form.password" type="password" class="input" />
        <div v-if="form.errors.password" class="is-invalid">{{ form.errors.password }}</div>
      </div>
      <div>
        <button class="btn-primary w-full" type="submit">Login</button>

        <div class="mt-2 text-center">
          <Link :href="route('user-account.create')" class="text sm tex-gray-500">Need account ? Click here</Link>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  email: null,
  password: null,
})

const login = () => form.post(route('login.store'))
</script>