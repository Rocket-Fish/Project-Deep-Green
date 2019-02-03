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

.absolute_middle {
    height: 65px;
    width: 65px;
    position: fixed;
    left: 50%;
    margin-left: -32px;
    top: 50%;
    margin-top: -32px;

}

///////////////// stuff for the spinner
/////////// from epic spinners
.fingerprint-spinner, .fingerprint-spinner * {
      box-sizing: border-box;
    }

    .fingerprint-spinner {
      height: 64px;
      width: 64px;
      padding: 2px;
      overflow: hidden;
      position: relative;
    }

    .fingerprint-spinner .spinner-ring {
      position: absolute;
      border-radius: 50%;
      border: 2px solid transparent;
      border-top-color: #FF7400;
      animation: fingerprint-spinner-animation 1500ms cubic-bezier(0.680, -0.750, 0.265, 1.750) infinite forwards;
      margin: auto;
      bottom: 0;
      left: 0;
      right: 0;
      top: 0;
    }

    .fingerprint-spinner .spinner-ring:nth-child(1) {
      height: calc(60px / 9 + 0 * 60px / 9);
      width: calc(60px / 9 + 0 * 60px / 9);
      animation-delay: calc(50ms * 1);
    }

    .fingerprint-spinner .spinner-ring:nth-child(2) {
      height: calc(60px / 9 + 1 * 60px / 9);
      width: calc(60px / 9 + 1 * 60px / 9);
      animation-delay: calc(50ms * 2);
    }

    .fingerprint-spinner .spinner-ring:nth-child(3) {
      height: calc(60px / 9 + 2 * 60px / 9);
      width: calc(60px / 9 + 2 * 60px / 9);
      animation-delay: calc(50ms * 3);
    }

    .fingerprint-spinner .spinner-ring:nth-child(4) {
      height: calc(60px / 9 + 3 * 60px / 9);
      width: calc(60px / 9 + 3 * 60px / 9);
      animation-delay: calc(50ms * 4);
    }

    .fingerprint-spinner .spinner-ring:nth-child(5) {
      height: calc(60px / 9 + 4 * 60px / 9);
      width: calc(60px / 9 + 4 * 60px / 9);
      animation-delay: calc(50ms * 5);
    }

    .fingerprint-spinner .spinner-ring:nth-child(6) {
      height: calc(60px / 9 + 5 * 60px / 9);
      width: calc(60px / 9 + 5 * 60px / 9);
      animation-delay: calc(50ms * 6);
    }

    .fingerprint-spinner .spinner-ring:nth-child(7) {
      height: calc(60px / 9 + 6 * 60px / 9);
      width: calc(60px / 9 + 6 * 60px / 9);
      animation-delay: calc(50ms * 7);
    }

    .fingerprint-spinner .spinner-ring:nth-child(8) {
      height: calc(60px / 9 + 7 * 60px / 9);
      width: calc(60px / 9 + 7 * 60px / 9);
      animation-delay: calc(50ms * 8);
    }

    .fingerprint-spinner .spinner-ring:nth-child(9) {
      height: calc(60px / 9 + 8 * 60px / 9);
      width: calc(60px / 9 + 8 * 60px / 9);
      animation-delay: calc(50ms * 9);
    }

    @keyframes fingerprint-spinner-animation {
      100% {
        transform: rotate( 360deg );
      }
    }
</style>
