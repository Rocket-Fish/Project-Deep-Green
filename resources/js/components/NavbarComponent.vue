<template>
  <!-- App Navbar Header -->
  <div>

    <b-navbar :fixed="'top'" toggleable="sm" type="dark" variant="primary">
      <div class="container">
        <b-navbar-brand :to="{ name: 'home' }" href="#"@click.native="currentTab = tabs[0]"><strong>Deep Green Ocean</strong></b-navbar-brand>

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-collapse is-nav id="nav_collapse">

          <b-navbar-nav  v-for="tab in tabs" v-if="tab.name !== none" :key="tab.name">
            <b-nav-item :to="{ name: tab.route }" class="nav-link" href="#" @click.native="currentTab = tab" :active="tab === currentTab">{{tab.name}}</b-nav-item>
          </b-navbar-nav>

          <b-navbar-nav class="ml-auto">
              <b-nav-item-dropdown right>
              <!-- Using button-content slot -->
              <template slot="button-content">
                <em v-if="!$auth.check()">Inconspicuous</em>
                <em v-if="$auth.check()">{{$auth.user().name}}</em>
              </template>
              <b-dropdown-item v-if="!$auth.check()" :to="{name:'login'}">Login</b-dropdown-item>
              <b-dropdown-item v-if="!$auth.check()":to="{name:'register'}">Register</b-dropdown-item>
              <b-dropdown-item v-if="$auth.check()":to="{name:'dashboard'}">Dashboard</b-dropdown-item>
              <b-dropdown-item v-if="$auth.check()" @click.prevent="$auth.logout()">Signout</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </div>
    </b-navbar>


  </div>
</template>

<script>
const none = 'None'

// note that the first tab being none so we don't start with one highlighted
const tabs = [
  {
    name: none,
  },
  {
    name: 'Projects',
    route: 'projects'
  },
]

let currentTab = tabs[0];

export default {
  data() {
    return {
      none: none,
      tabs: tabs,
      currentTab: currentTab
    }
  }
}
</script>

<style scoped>

</style>
