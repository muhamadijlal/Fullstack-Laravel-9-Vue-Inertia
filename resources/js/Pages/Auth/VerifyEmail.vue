<template>
  <div>You should be verified first to see this page.</div>
  <div>
    <Link 
      :href="route('verification.send')" 
      method="POST" 
      as="button" 
      class="text-indigo-600 dark:tecxt-indigo-400"
    >
      Resend verification email
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>