<template>
<div>
<footer>
  <br><br><br>

  <div class="container footer">
    <div class="foot">
      <h4>Категории</h4>
      <hr>
      <div class="border-bottom">
    <ul class="">
      <li class="nav" v-for="tag in $store.state.tags.tags" :key="tag.id">

        <nuxt-link :to="{name:'tags-id-tag_article_index',params:{id:tag.id}}">{{tag.name}}</nuxt-link>
      </li>
    </ul>
  </div>
    </div>
    <div class="foot mb-3">
      <h4>Контакты</h4>
      <hr>
      <p><i class="fas fa-phone-square"></i>  (096)-69-08-748</p>
      <p><i class="fas fa-at"></i>  dizacomua@gmail.com</p>
      <p><i class="fas fa-address-card"></i>  Кривой Рог</p>
    </div>
    <div class="foot">
      <h4>Обратная связь</h4>
      <hr>
      <nuxt-link to="/" class="button shadow-lg"><i class="fas fa-user-edit"></i>&nbsp;написать админ..</nuxt-link>
    </div>
  </div>
  <br>
  <img src="~/assets/logo.png" class="logob">
 </footer>

 <div class="maunt">
</div>

<a class="top" href="#top"><i class="fas fa-arrow-up fa-3x"></i></a>


</div>
</template>


<style scoped>

 .maunt {
    width:100%;
    height: 400px;
    clip-path: polygon(0 78%, 28% 99%, 45% 83%, 62% 91%, 80% 65%, 100% 100%, 19% 100%, 7% 100%, 0 100%);
    background:rgba(120,120,120,.7);
    margin-top: -400px;
    position: absolute;
    z-index: 1000;
  }

  .top {
    position: fixed;
    bottom: 50px;
    right: 50px;
    color: #29a137;
  }

  .top:hover {
    color: #5f5549;
  }


  footer {
    height: 400px;
    background: #352c26;
    font-size: 14px;
  }

  .footer {
    display: flex;
    justify-content: space-around;
flex-wrap: wrap;
  }

  .foot h4{
    color: #5f5549;
  }

  footer p {
    color: #fff;
  }

  footer a{
    color: #29a137;
    list-style: none;
    text-decoration: none;
  }

  footer a:hover {
    color: #fff;
  }

  .logob{
    width: 100px;
    position: absolute;
    left: 30%;
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
  }

  .button:hover {
    background: #5f5549;
    transition: 1s;
  }

  @media screen and (max-width: 1200px) {


}

@media screen and (max-width: 768px) {


  footer {
    height: 500px;
  }
}

</style>