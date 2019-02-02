<template>
    <div class="overlay_container">
        <b-container>
            <b-row>
                <b-col col lg="6" class="shaded_background">
                    <H1>
                        <span class="line">Hello,</span>
                        <span class="line">my name is Jimmy Zhang</span>
                    </H1>
                </b-col>
            </b-row>
            <b-row>
                <b-col col lg="6" class="shaded_background">
                    <H4>
                      <span class="line">I am a</span>
                      <span class="line">Full Stack Web Developer</span>
                    </H4>
                </b-col>
            </b-row>
            <b-row>
                <b-col col lg="6" class="shaded_background">
                    <b-button :size="'lg'" :variant="'primary'" :to="{name:'projects'}">Projects Showcase</b-button>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<style lang="scss" scoped>
.overlay_container {
    height:80%;
    width:100%;
    padding-top:20%;
}

.shaded_background {
    background-color:rgba(0, 0, 0, 0.3);
}

</style>
