<template>
  <div class="home-box col-lg-6">
    <div class="row">
      <div class="col-lg">
        <H1>Deep Green Ocean</H1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg">
        <H4>A showcase of projects</H4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg">
        <H5>By Jimmy Zhang</H5>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.home-box{
    margin-top:20%;
    background-color: rgba(0, 0, 0, 0.3);

    // set a variable for the font size
    $h1-size: 2em;
    $h2-size: 1.5em;
    $h3-size: 1.3em;
    $h4-size: 1em;
    $h5-size: 0.8em;
    $h6-size: 0.7em;

    @function scaleUp($var) {
      @return $var*1.9;
    }

    @media screen and (min-width: 1300px) {
      h1 {
        font-size: scaleUp($h1-size);
      }
      h4 {
        font-size: scaleUp($h4-size);
      }
      h5 {
        font-size: scaleUp($h5-size);
      }
    }
  }
</style>
