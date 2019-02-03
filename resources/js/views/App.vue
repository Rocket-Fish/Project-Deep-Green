<template>
  <div>
    <navbar-component></navbar-component>
    <div class = "non-nav-items">
      <transition
      @before-enter="beforeEnter"
      @enter="enter"
      @after-enter="afterEnter"
      @enter-cancelled="enterCancelled"

      @before-leave="beforeLeave"
      @leave="leave"
      @after-leave="afterLeave"
      @leave-cancelled="leaveCancelled"
      :css="false"
      mode="out-in">
          <router-view></router-view>
      </transition>
    </div>

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
  </div>
</template>
<script>
  const Velocity = require('velocity-animate');

  export default {
      data() {
          return {
              is_transitioning: false,
          }
      },
      methods: {
        beforeEnter(el) {
          el.style.opacity = 0
          this.is_transitioning = true;
        },
        enter(el, done) {
            Velocity(el, { opacity: 1}, { duration: 600 })
            Velocity(el, { complete: done })
//            done()
        },
        afterEnter(el) {
            el.style.opacity = 1
            this.is_transitioning = false;
        },
        enterCancelled(el) {
            this.is_transitioning = false;
        },

        beforeLeave(el) {
            el.style.opacity = 1
            this.is_transitioning = true;
        },
        leave(el, done) {
            Velocity(el, { opacity: 0 }, { duration: 400 })
            Velocity(el, { complete: done })
//          done()
        },
        afterLeave(el) {
            el.style.opacity = 0
        },
        leaveCancelled(el) {
        }
      }
  }
</script>
<style lang="scss" scoped>
</style>
