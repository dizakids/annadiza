<template>
  <div>
    <div class="container col-md-6 mt-5">
      <h2><i class="fas fa-user-edit"></i> Редактирование пользователя</h2>
      <form @submit.prevent="update">
        <div class="form-group">
          <label class="form">Имя</label><small class="text-danger star">* </small>
          <input v-bind:style="nameError" type="text" class="form-control" v-model="profile.name" placeholder="* Пожалуйста, введите ваше имя" autofocus>
          <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
        </div>

        <div class="form-group">
          <label class="form">Адрес электронной почты</label><small class="text-danger star">* </small>
          <input v-bind:style="emailError" type="text" class="form-control" v-model="profile.email" placeholder="* Пожалуйста, введите свой адрес электронной почты">
          <small v-if="errors.email" class="form-text text-danger">{{errors.email[0]}}</small>
        </div>

        <div class="form-group">
          <label class="profile">пароль</label>
          <input v-bind:style="passwordError" type="text" class="form-control" v-model="profile.password" placeholder="Пожалуйста, введите ваш пароль">
          <small v-if="errors.password" class="form-text text-danger">{{errors.password[0]}}</small>
        </div>

        <div class="form-group">
          <p class="profile">Список тегов</p>
          <span v-for="tag in $store.state.tags.tags" :key="tag.id">
            <input type="checkbox" :value="tag.id" :id="tag.id" v-model="profile.tags">
            <label class="profile" :for="tag.id">{{tag.name}}&nbsp;&nbsp;&nbsp;</label>
          </span>
        </div>

        <div class="form-group">
          <label class="profile">Возраст</label>
          <input v-bind:style="ageError" type="number" class="form-control" v-model="profile.age" placeholder="Пожалуйста, введите ваш возраст">
          <small v-if="errors.age" class="form-text text-danger">{{errors.age[0]}}</small>
        </div>

        <div class="form-group">
          <label class="profile">Пол</label>
          <input type="text" class="form-control" v-model="profile.gender" placeholder="Пожалуйста, укажите ваш пол">
          <small v-if="errors.gender" class="form-text text-danger">{{errors.gender[0]}}</small>
        </div>

        <div class="form-group">
          <label class="profile">Почтовый индекс</label>
          <input v-model="profile.post_code" type="text" class="form-control" placeholder="Пожалуйста, введите ваш почтовый индекс">
          <small class="form-text text-danger" v-if="errors.post_code">{{errors.post_code[0]}}</small>
        </div>

        <div class="form-group">
          <label class="profile">Город</label>
          <select v-bind:style="prefectureCodeError" v-model="profile.prefecture_code" class="form-control">
            <option disabled value="">-- Пожалуйста, выберите --</option>
            <option v-for="(pref,index) in $store.state.prof.prefs" :key="index" :value="index">{{pref}}</option>
          </select>
          <small class="form-text text-danger" v-if="errors.prefecture_code">{{errors.prefecture_code[0]}}</small>
        </div>

        <div class="form-group">
          <label class="profile">Другой адрес</label>
          <input v-model="profile.address" type="text" class="form-control" placeholder="Пожалуйста, введите другой адрес">
          <small class="form-text text-danger" v-if="errors.address">{{errors.address[0]}}</small>
        </div>
        <button class="button"><i class="fas fa-share"></i> Обновить</button>
        <button @click.prevent="deleteUser" class="but"><i class="fas fa-user-minus"></i> Удалить пользователя</button>
      </form>
      <br>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      profile: {
        id: '',
        name: '',
        email: '',
        password: '',
        age: '',
        gender: '',
        post_code: '',
        prefecture_code: '',
        address: '',
        tags: [],
      }
    };
  },
  watch: {
    'profile.post_code': function(post_code) {
      let _this = this
      new YubinBango.Core(post_code, function(addr) {
        _this.profile.prefecture_code  = addr.region_id
        _this.profile.address = addr.locality + addr.street
      })
    }
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get(`/user`);
    return {
      profile: data
    }
  },
  methods: {
    update() {
      this.$axios.$patch(`/${this.profile.id}`, {
        name: this.profile.name,
        email: this.profile.email,
        password: this.profile.password,
        age: this.profile.age,
        gender: this.profile.gender,
        post_code: this.profile.post_code,
        prefecture_code: this.profile.prefecture_code,
        address: this.profile.address,
        tags: this.profile.tags
      }).then(data=> {
        console.log(this.profile);
        this.$router.push("/");
      }).catch(err => {
        console.log(err);
      });
    },
    deleteUser() {
      this.$auth.logout();
      this.$axios.$delete(`/${this.profile.id}`);
      this.$router.push('/');
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
 .button {
    background: #29a137;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 200px;
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

 .but {
    background: red;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 220px;
    transition: 1s;
    text-decoration: none;
    border: none;
    border-radius: 0;
    outline: none;
    float: right;
  }

  .but:hover {
    background: #5f5549;
    transition: 1s;
  }

 h2 {
    color: #5f5549;
  }

</style>
