<template>
  <div>Index</div>
  <div>{{ content }}</div>
</template>

<script setup>
defineProps({
  content: String,
})
</script>