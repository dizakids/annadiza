<template>

<div>

  <div class="cite"><i class="fas fa-quote-right"></i> Лучше гор могут быть только горы, на которых еще не бывал.
  </div>

  <no-ssr>
    <swiper :options="sliderMenu">
      <swiper-slide>
        <div>
          <a href="/"><img src="~/assets/image/slide1.jpg"></a>
          <h4><i class="fas fa-quote-right"></i> Горы — это хорошо. Когда ты здесь, всё плохое остаётся внизу, и на душе становится так легко. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
           <a href="/"><img src="~/assets/image/slide2.jpg"></a>
           <h4><i class="fas fa-quote-right"></i> В горах между людьми возникают особые связи. Поэтому меня тянет к ним так неудержимо. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
           <a href="/"><img src="~/assets/image/slide3.jpg"></a>
           <h4><i class="fas fa-quote-right"></i> Чтобы узнать, высока ли гора, взбираться на неё не обязательно.. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
          <a href="/"><img src="~/assets/image/slide4.jpg"></a>
          <h4><i class="fas fa-quote-right"></i> Природа создала горы в наказание людям, когда ей захотелось их унизить. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
           <a href="/"><img src="~/assets/image/slide5.jpg"></a>
           <h4><i class="fas fa-quote-right"></i> Горы калят характер, дают спартанское воспитание и, конечно, учат разбираться в людях. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
           <a href="/"><img src="~/assets/image/slide6.jpg"></a>
           <h4><i class="fas fa-quote-right"></i> Лжи не место в горах. Маски обмана вдребезги разбиваются об их каменный характер. </h4>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div>
           <a href="/"><img src="~/assets/image/slide7.jpg"></a>
           <h4><i class="fas fa-quote-right"></i> Человек, сидящий на вершине горы — не упал туда с неба.. </h4>
      </div>
    </swiper-slide>

        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev swiper-button-white" slot="button-prev"></div>
        <div class="swiper-button-next swiper-button-white" slot="button-next"></div>
    </swiper>
  </no-ssr>

  <div class="maunt"></div>

  <br><br><br><br><br>

  <div class="container">

  <h2><i class="fab fa-ethereum"></i>&nbsp;Категории</h2>
    <hr size="10px" color="#29a137">

<div v-for="category in main_categories" :key="`new-${category.id}`">
      <p>{{ category.name }}</p>
    </div>

    <h2><i class="fab fa-ethereum"></i>&nbsp;TOP вершины континентов</h2>
    <hr size="10px" color="#29a137">
    <no-ssr>
      <swiper :options="slider3d">
        <swiper-slide v-for="article in new_articles" :key="`new-${article.id}`">
          <div>
            <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="link-border">
              <img :src="'http://127.0.0.1:8000/show_image/swiper_' + article.image">
              <br>
              <p><i class="fab fa-ethereum"></i>&nbsp;{{ article.title }}</p>
            </nuxt-link>
          </div>
        </swiper-slide>
        <div class="swiper-button-prev swiper-button-black" slot="button-prev"></div>
        <div class="swiper-button-next swiper-button-black" slot="button-next"></div>
      </swiper>
      <br>
    </no-ssr>

  <br><br><br><br>

  <h2><i class="fas fa-newspaper"></i>&nbsp;Новые статьи</h2>
  <hr size="10px" color="#29a137">

  <div class="row new">
    <div class="col_35 data shadow mb-5 pl-3 pr-3 pb-3 " v-for="article in new_articles" :key="`new-${article.id}`">

      <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="mr-5 pr-5 ">
        <div>
          <img class="shadow" :src="'http://127.0.0.1:8000/show_image/thumb_main_' + article.image">

        </div>
      </nuxt-link>

       <h3><i class="fab fa-ethereum"></i> {{ article.title }}</h3>
          <p v-html="article.text"></p>
            <nuxt-link :to="{name:'articles-id',params:{id:article.id}}">
        <div class="right">
          подробнее <i class="fas fa-hand-point-right"></i>
        </div>
      </nuxt-link>
    </div>
  </div>

  <br>

  <div class="text-right">
    <nuxt-link to="/articles/new_arrivals_index" class="button shadow-lg">
      <i class="fas fa-newspaper"> </i>&nbsp;Все статьи </i>
    </nuxt-link>
  </div>

  <br><br><br>

  <h2><i class="fas fa-fire-alt"></i>&nbsp;Популярные статьи</h2>
   <hr size="10px" color="#29a137">

  <no-ssr>
    <swiper :options="swiperOption">
          <swiper-slide v-for="article in home_articles" :key="`home-${article.id}`">
            <div class="example treug">
              <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="link-border">
                <img :src="'http://127.0.0.1:8000/show_image/swiper_' + article.image">
                <h6 class="shadow">{{ article.title }}</h6>
            <!--     <p v-html="article.text"></p> -->
              </nuxt-link>
            </div>
          </swiper-slide>
          <div class="swiper-button-prev swiper-button-black" slot="button-prev"></div>
          <div class="swiper-button-next swiper-button-black" slot="button-next"></div>
    </swiper>

     <hr>

  </no-ssr>

  <br><br><br>

  <h2><i class="fas fa-video"></i>&nbsp;Видео</h2>
  <hr size="10px" color="#29a137">

  <!-- <section class="video">

    <video src="~assets/fon.mp4" autoplay loop controls width="100%">
    </video>

    <h5><i class="fas fa-photo-video"></i>  Горные пейзажи</h5>
    <video class="video1" src="~assets/4.MP4" controls width="37%" poster="~assets/image/1.jpg"></video>
     <video class="video2" src="~assets/1.mp4" controls width="37%"></video>
   </section> -->

  <hr>

  <br><br><br>

  <h2><i class="fas fa-images"></i>&nbsp;Галерея</h2>
  <hr size="10px" color="#29a137">

  </div>

  <div class="inline">
    <div class="line" v-for="photo in main_photos" :key="`new-${photo.id}`">
      <a :href="'http://127.0.0.1:8000/show_image/' + photo.image" data-fancybox="gallery" :data-caption="photo.title" >
        <img :src="'http://127.0.0.1:8000/show_image/thumb_main_' + photo.image" >
      </a>
    </div>
  </div>

  <br>

  <nuxt-link to="/photos/new_foto" class="button shadow-lg mr-5"><i class="fas fa-images"></i>&nbsp;больше фото..</nuxt-link>

  <br><br><br>

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59911224.84759813!2d75.55210045096594!3d8.157683358239728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e854a215bd9ebd%3A0x576dcf806abbab2!2z0JTQttC-0LzQvtC70YPQvdCz0LzQsA!5e0!3m2!1sru!2sua!4v1565965323207!5m2!1sru!2sua" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>

</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data() {
    return {

      new_articles: [],
      new_photos: [],
      home_articles: [],
      main_photos: [],
      main_categories: [],

      swiperOption: {
        slidesPerView: 3,
        spaceBetween: 3,
        loop: true,
        centeredSlides: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        },
        autoplay: {
          delay: 4000,
          disableOnInteraction: false
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      },

    slider3d: {
      effect: 'coverflow',
      grabCursor: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true,
      },
      slidesPerView: 4,
        spaceBetween: 3,
        loop: true,
        centeredSlides: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
           type: 'progressbar',
        },
        autoplay: {
          delay: 4000,
          disableOnInteraction: false
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
    },

    sliderMenu: {
      slidesPerView: 1,
      autoplay: {
        delay: 6000,
        disableOnInteraction: false
      },
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        clickable: true,
      },
    },
  }
  },

  async asyncData({$axios}) {
  const data = await $axios.$get(`/articles`);

    return {
      new_articles: data.new,
      home_articles: data.home,
      new_photos: data.photos,
    new_category: data.category,
      main_photos: data.gall,
      main_categories: data.catm,
    }
  },

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
    float: right;
    transition: 1s;
    text-decoration: none;
  }

  .button:hover {
    background: #5f5549;
    transition: 1s;
  }

  h5 {
    position: absolute;
    z-index: 20;
    color: #352c26;
    left: 10%;
    top: 10%;
    font-size: 30px;
  }

  .video {
    position: relative;
  }

  .video1 {
    position: absolute;
    z-index: 20;
    left: 50%;
    top: 10%;
    opacity: 0.6;
  }

  .video2 {
    position: absolute;
    z-index: 20;
    left: 50%;
    top: 50%;
    opacity: 0.8;
  }

  .video2:hover, .video1:hover {
    opacity: 1;
  }

  .maunt {
    width:100%;
    height: 400px;
    clip-path: polygon(0 78%, 28% 99%, 45% 83%, 62% 91%, 80% 65%, 100% 100%, 19% 100%, 7% 100%, 0 100%);
    background:rgba(120,120,120,.7);
    margin-top: -400px;
    position: absolute;
    z-index: 1000;
  }

  .inline {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    flex-direction: row-reverse;
  }

  .line {
    width: 20%;
  }

  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
  }

  .data {
    background-color: #f8f8f8;
    border: 15px solid white;
  }

  .data:hover {
    background: #f1f1f1;
  }

  .new  p {
      color: #352c26;
    }

  .new h3 {
      color: #5f5549;
  }

  .col_35 {
    width: 30%;
    flex-wrap: wrap;
  }
  .new {
    justify-content: space-around;
  }

  .example {
    position: relative;
  }

  .example p {
    position: absolute;
    color: white;
    top: 90%;
    left: 0;
  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .swiper-slide h4 {
    position: absolute;
    top: 43%;
    left: 10%;
    width: 60%;
    color: #fff;
    background:rgba(77,64,55,.5);
    padding: 20px;
  }

  .right {
    float: right;
    color: #29a137;
  }

  .right:hover {
    color: #352c26;
  }


  .swiper-slide a {
    color: #352c26;
    text-decoration: none;
    cursor: grab;
  }

  .swiper-slide a:hover {
    color: #29a137;
  }

  .swiper-slide p {
    margin-top:10px;
    cursor: pointer;
  }

  .cite {
    background:rgba(120,120,120,.7);
    color: #352c26;
    padding: 10px;
    text-align: center;
    font-size: 18px;
  }

  h2 {
    color: #352c26;
  }

  .treug {
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
  }

@media screen and (max-width: 1200px) {

 .col_35 {
  width: 50%;
  text-align: center;
  }
}

@media screen and (max-width: 768px) {

 .col_35 {
  width: 90%;
  text-align: center;
  }

  .swiper-slide h4 {

    top: 30%;
    left: 10%;
    width: 80%;
   font-size: 16px;
  }
  .maunt {
    background:rgba(120,120,120,.2);
  }
}
</style>
