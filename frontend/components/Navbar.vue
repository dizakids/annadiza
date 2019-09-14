<template>

<div class="container p-0">
  <div class="topMenu">
    <a href="#"><i class="fab fa-twitter"></i>&nbsp;</a>
    <a href="#"><i class="fab fa-instagram">&nbsp;</i></a>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
 </div>
    <div v-if="!authenticated" class="float-right down userInformation">
      <nuxt-link to="/about" class="link">О нас&nbsp;</nuxt-link>
      <nuxt-link to="/users/login" class="link"><i class="fas fa-sign-in-alt"></i>Войти&nbsp;</nuxt-link>
      <nuxt-link to="/users/register" class="link"><i class="fas fa-user-edit"></i>Регистрация</nuxt-link>
    </div>

    <div v-if="authenticated" class="float-right down userInformation">
      <nuxt-link to="/users/profile" class="link"><i class="fas fa-user"></i>{{user.name}}&nbsp;</nuxt-link>
      <a href="" @click.prevent="logout" class="link"><i class="fas fa-sign-out-alt"></i>Выйти</a>
    </div>
    <div class="h1">
        <h1><i class="fab fa-ethereum"></i>&nbsp;Красота &nbsp;&nbsp;&nbsp;гор</h1>
    </div>


    <nuxt-link to="/" ><img src="~/assets/logo.png" class="logo"></nuxt-link>
    <br>

    <div v-if="authenticated && user.admin" class="float-right down">
      <nuxt-link to="/manager"><i class="fas fa-users-cog"></i></nuxt-link>
    </div>


  <div class="menu">
    <ul class="nav nav-justified tags">
      <li class="nav-item" v-for="tag in $store.state.tags.tags" :key="tag.id">
        <i class="fas fa-mountain span"></i>
        <nuxt-link :to="{name:'tags-id-tag_article_index',params:{id:tag.id}}" class="nav-link tag">{{tag.name}}</nuxt-link>
      </li>
    </ul>
  </div>
  <br>

</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  methods: {
    logout() {
      this.$auth.logout()
    }
  },
};
</script>

<style scoped>
i{
  display:inline;
}
  .logo {
    position: relative;
    left: 55%;
    margin: 0 0 0 -120px;
    width: 200px;
  }

  .h1 {
    float: left;
    position: absolute;
    left: 10%;
    text-align: center;
    border: 120px solid transparent;
    border-top: 120px solid #29a137;
    width: 120px; height: 120px;
  }

  h1{
    margin-top: -110px;
    font-size: 26px;
    margin-left: -50px;
    text-align: center;
    color: #352c26;
  }
  .tags {
    z-index: 100;
    position: relative;
  }
  .span {
    margin-top: 20px;
    color: #5f5549;
  }

  .tag {
    color: #29a137;
    padding: 0;
    transition: 0.5s;
  }

  .tag:hover {
    transform: scale(1.2);
    transition: 0.5s;
  }

  a{
    color: #352c26;
    text-decoration: none;
  }

  a:hover {
    color: #29a137;
  }

  .topMenu{
    position: absolute;
    left: 5%;
    z-index: 10;
  }
  @media screen and (max-width: 1200px) {


}

@media screen and (max-width: 768px) {

.logo{
width: 150px;
 left: 75%;
  top: 50px;
}

.menu {
  margin-top: 100px;

}
}

</style>