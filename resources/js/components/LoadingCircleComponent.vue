<template>
    <div v-if="is_transitioning"class="absolute_middle">
        <div class="fingerprint-spinner">
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
          <div class="spinner-ring"></div>
        </div>
    </div>
</template>
<script>
const Velocity = require('velocity-animate');

export default {
    props:{
        is_transitioning: Boolean,
    }
}
</script>
<style lang="scss" scoped>
</style>
