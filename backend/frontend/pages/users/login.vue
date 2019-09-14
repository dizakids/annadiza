<template>
  <div class="container col-md-6 mt-5">
    <h2><i class="fas fa-sign-in-alt"></i> Войти в систему</h2>
    <br>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label class="form">Адрес электронной почты</label>
        <input v-bind:style="emailError" v-model.trim="form.email" type="email" class="form-control" placeholder="Пожалуйста, введите ваш адрес электронной почты" autofocus>
        <small class="form-text text-danger" v-if="errors.email">{{errors.email[0]}}</small>
      </div>
      <div class="form-group">
        <label class="form">Пароль</label>
        <input v-bind:style="passwordError" v-model.trim="form.password" type="password" class="form-control" placeholder="Пожалуйста, введите ваш пароль">
        <small class="form-text text-danger" v-if="errors.password">{{errors.password[0]}}</small>
      </div>
      <button type="submit" class="login-btn button"><i class="fas fa-share"></i> Войти</button>
      <nuxt-link to="/users/register">&nbsp;&nbsp;&nbsp;Еще не зарегистрированы？</nuxt-link>

    </form>
    <br><br><br><br>
  </div>
</template>

<script>
export default {
  middleware: ['guest'],
  data() {
    return {
      form: {
        email: '',
        password: '',
      }
    }
  },
  methods: {
    submit() {
      this.$auth
      .loginWith("local", {
        data: {
          email: this.form.email,
          password: this.form.password
        }
      })
      .then(data => {
        this.$router.push("/");
      })
      .catch(err => {
        console.log(err);
      });
    },
  },
  computed: {
    emailError: function() {
      return {
        border: !!this.errors.email ? '2px solid #FA514B' : ''
      }
    },
    passwordError: function() {
      return {
        border: !!this.errors.password ? '2px solid #FA514B' : ''
      }
    }
  }
};
</script>

<style scoped>
  .login-title {
    color: #FCAA00;
  }

  .form {
    color: #4D4D4D
  }

  h2 {
    color: #5f5549;
  }

   .button {
    background: #29a137;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 200px;
    float: right;
    transition: 1s;
    text-decoration: none;
    border: none;
    border-radius: 0;
    outline: none;
  }

  .button:hover {
    background: #5f5549;
    transition: 1s;
  }

  a {
    color: #29a137;
    text-decoration: none;
  }

  a:hover {
    color: #5f5549;
  }

</style>