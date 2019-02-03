<template>
    <b-container>
        <b-row>
            <b-col col lg="6" class="shaded_background first_row">
                <H1>
                    <span class="line">404</span>
                    <span class="line">Page Not Found</span>
                </H1>
            </b-col>
        </b-row>
        <b-row>
            <b-col col lg="6" class="shaded_background first_row">
                <H4>
                  <span class="line">A whale may have consumed this page</span>
                </H4>
            </b-col>
        </b-row>
        <b-row>
            <b-col col lg="6" class="shaded_background first_row">
                <b-button :size="'lg'" :variant="'success'" :to="{name:'home'}"> Go Home </b-button>
            </b-col>
        </b-row>

    </b-container>
</template>
<style lang="scss" scoped>
</style>
