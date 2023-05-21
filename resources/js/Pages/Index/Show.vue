<template>
  <div>Show page</div>
  <div>{{ content }}</div>
</template>

<script setup>
defineProps({
  content: String,
})
</script>