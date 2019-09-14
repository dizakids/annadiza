<template>
  <div class="container col-md-6 mt-5">
    <h2><i class="fas fa-user-edit"></i> Регистрация пользователя</h2>
    <br>
    <form @submit.prevent="submit">

      <div class="form-group">
        <label class="form">Имя</label><small class="text-danger star">* </small>
        <input v-bind:style="nameError" v-model.trim="form.name" type="text" class="form-control" placeholder="Пожалуйста, введите ваше имя" autofocus>
        <small class="form-text text-danger" v-if="errors.name">{{errors.name[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Адрес электронной почты</label><small class="text-danger star">* </small>
        <input v-bind:style="emailError" v-model.trim="form.email" type="email" class="form-control" placeholder="Пожалуйста, введите свой адрес электронной почты">
        <small class="form-text text-danger" v-if="errors.email">{{errors.email[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Пароль</label><small class="text-danger star">*</small>
        <input v-bind:style="passwordError" v-model.trim="form.password" type="password" class="form-control" placeholder="Пожалуйста, введите ваш пароль">
        <small class="form-text text-danger" v-if="errors.password">{{errors.password[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Возраст</label>
        <input v-bind:style="ageError" v-model.trim="form.age" type="number" class="form-control" placeholder="Пожалуйста, введите ваш возраст">
        <small class="form-text text-danger" v-if="errors.age">{{errors.age[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Пол</label>
        <select class="form-control" v-model="form.gender">
          <option disabled value="">Пожалуйста, выберите ваш пол</option>
          <option>м</option>
          <option>ж</option>
        </select>
        <small class="form-text text-danger" v-if="errors.gender">{{errors.gender[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Почтовый индекс</label>
        <input v-model="form.post_code" type="text" class="form-control" placeholder="Почтовый индекс">
        <small class="form-text text-danger" v-if="errors.post_code">{{errors.post_code[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Город</label>
        <select v-bind:style="prefectureCodeError" v-model="form.prefecture_code" class="form-control">
          <option disabled value="">-- Пожалуйста, выберите --</option>
          <option v-for="(pref,index) in $store.state.prof.prefs" :key="index" :value="index">{{pref}}</option>
        </select>
        <small class="form-text text-danger" v-if="errors.prefecture_code">{{errors.prefecture_code[0]}}</small>
      </div>

      <div class="form-group">
        <label class="form">Другой адресс</label>
        <input v-model="form.address" type="text" class="form-control" placeholder="Другой адрес">
        <small class="form-text text-danger" v-if="errors.address">{{errors.address[0]}}</small>
      </div>

      <button type="submit" class="register-btn button"><i class="fas fa-share"></i> Отправить</button>
      <nuxt-link to="/users/login">&nbsp;&nbsp;&nbsp;Уже зарегистрированны</nuxt-link>
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
        name: '',
        email: '',
        password: '',
        age: '',
        gender: '',
        post_code: '',
        prefecture_code: '',
        address: '',
        tags: []
      }
    }
  },
  watch: {
    'form.post_code': function(post_code) {
      let _this = this
      new YubinBango.Core(post_code, function(addr) {
        _this.form.prefecture_code  = addr.region_id
        _this.form.address = addr.locality + addr.street
      })
    }
  },
  methods: {
    submit() {
      this.$axios
      .$post("register", this.form)
      .then(data => {
        this.$auth.loginWith("local", {
          data: {
            email: this.form.email,
            password: this.form.password,
          }
        });
        console.log(data);
        this.$router.push("/");
      })
      .catch(err => {
        console.log(err);
      });
    }
  },
  computed: {
    nameError: function() {
      return {
        border: !!this.errors.name ? '1px solid #FA514B' : ''
      }
    },
    emailError: function() {
      return {
        border: !!this.errors.email ? '1px solid #FA514B' : ''
      }
    },
    passwordError: function() {
      return {
        border: !!this.errors.password ? '1px solid #FA514B' : ''
      }
    },
    ageError: function() {
      return {
        border: !!this.errors.age ? '1px solid #FA514B' : ''
      }
    },
    prefectureCodeError: function() {
      return {
        border: !!this.errors.prefecture_code ? '1px solid #FA514B' : ''
      }
    }
  }
};
</script>

<style scoped>
  .register-title {
    color: #FCAA00;
  }

  .form {
    color: #4D4D4D
  }

  .register-btn {
    display: inline-block;
    padding: 0.3em 1em;
    text-decoration: none;
    color: white;
    background-color: #FCB932;
    border: solid 2px #FCB932;
    border-radius: 3px;
    transition: .4s;
  }

  .register-btn:hover {
    background: #FCCA65;
    color: white;
  }

  .star {
    font-size: 20px;
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
