<template>
  <div class="min-h-screen flex flex-col">
    <Navbar />
    <main class="flex-1 pt-[100px]">
      <slot />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '@/Components/Public/Navbar.vue'
import Footer from '@/Components/Public/Footer.vue'
</script>
