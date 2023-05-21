<template>
  <form @submit.prevent="register">
    <div class="w-1/2 mx-auto space-y-6">
      <div>
        <label for="name" class="label">Your name</label>
        <input id="name" v-model="form.name" type="text" class="input" autocomplete="off" />
        <div v-if="form.errors.name" class="is-invalid">{{ form.errors.name }}</div>
      </div>
      <div>
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
        <label for="password_confirmation" class="label">Password confirmation</label>
        <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input" />
        <div v-if="form.errors.password_confirmation" class="is-invalid">{{ form.errors.password_confirmation }}</div>
      </div>
      <div>
        <button class="btn-primary w-full" type="submit">Create account</button>

        <div class="mt-2 text-center">
          <Link :href="route('login')" class="text sm tex-gray-500">Already have an account ? Login</Link>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))
</script>