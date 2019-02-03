<template>
    <div class="d-flex justify-content-center">
        <b-card title="Login">
            <div class="alert alert-danger" v-if="error">
                <p>There was an error, unable to sign in with those credentials.</p>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" v-model="password" required>
                </div>
                <button type="submit" class="btn btn-default">Sign in</button>
            </form>
        </b-card>
    </div>
</template>
<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
      login(){
        this.$auth.login({
            params: {
              email: this.email,
              password: this.password
            },
            success: function () {},
            error: function () {
                this.error = true
            },
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        });
      },
    }
  }
</script>
