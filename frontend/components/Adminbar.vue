<template>

<div class="container">
  <div>

    <div v-if="!authenticated" class="float-right down userInformation">
      <nuxt-link to="/users/login" class="link">Войти&nbsp;</nuxt-link>
<nuxt-link to="/users/register" class="link">Регистрация</nuxt-link>
    </div>
    <div v-if="authenticated" class="float-right down userInformation">
      <nuxt-link to="/users/profile" class="link">{{user.name}}&nbsp;</nuxt-link>
      <a href="" @click.prevent="logout" class="link">Выйти</a>
    </div>
     <a href="/"><img src="~/assets/nuxt.jpg" class="logo"></a>
    <a href="/">Блог</a>
    <br>

    <div v-if="authenticated && user.admin">

    </div>
  </div>


   <br>
    <br>
<div class="row" v-if="authenticated && user.admin">
    <div class="col-md-2 col-md-offset-1">
      <nuxt-link to="/articles/list_articles">Статьи</nuxt-link>
      <nuxt-link to="/articles/create" class="btn btn-success"><i class="fas fa-plus"></i>  </nuxt-link>
    </div>

    <div class="col-md-2">
      <nuxt-link to="/categories">Категории</nuxt-link>
      <nuxt-link to="/categories/create" class="btn btn-success"><i class="fas fa-plus"></i>  </nuxt-link>
    </div>
    <div class="col-md-2">
      <nuxt-link to="/tags">Теги</nuxt-link>
      <nuxt-link to="/tags/create" class="btn btn-success"><i class="fas fa-plus"></i>  </nuxt-link>
    </div>
     <div class="col-md-2 col-md-offset-1">
      <nuxt-link to="/photos/list_photos">Галерея</nuxt-link>
      <nuxt-link to="/photos/create" class="btn btn-success"><i class="fas fa-plus"></i>  </nuxt-link>
    </div>
    <div class="col-md-2">
      <nuxt-link to="/users">Пользователи</nuxt-link>

    </div>


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
}
</script>


