<template>
  <div style="height:100%; width100%;">
    <div class="twenty-top styled-box col-lg-8">
      <div class="row">
        <div class="col-lg">
          <H1>
            <span class="line">Welcome to</span>
            <span class="line">Deep Green Ocean</span>
          </H1>
        </div>
      </div>
      <div class="row">
        <div class="col-lg">
          <H4>
            <span class="line">A Portfolio for</span>
            <span class="line">Jimmy Zhang,</span>
            <span class="line">Web Developer</span>
          </H4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg">
          <b-button :size="'lg'" :variant="'success'" :to="{name:'about'}"> Whos Jimmy? </b-button>
          <b-button :size="'lg'" :variant="'primary'" :to="{name:'projects'}"> Work Showcase > </b-button>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
</style>
