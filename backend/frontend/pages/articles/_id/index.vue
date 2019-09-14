<template>

  <div class="container col-md-9 mt-5">
    <div class="">
      <div v-if="authenticated && user.admin">
          <nuxt-link :to="{name:'articles-id-edit',params:{id:main.id}}">
            <i class="far fa-edit"></i>
          </nuxt-link>
      </div>

      <div>
        <nuxt-link to="/">
        &nbsp;&nbsp;  &nbsp;&nbsp;<i class="fas fa-home"></i> Главная
      </nuxt-link>

      <section class="right mr-5" v-for="tag in main.tags" :key="tag.id">
        &nbsp;  тег:
        <nuxt-link :to="{name:'tags-id-tag_article_index',params:{id:tag.id}}">  {{tag.name}}</nuxt-link>
      </section>

      <h3> {{ main.category_id }}</h3>

        <h2><i class="fas fa-mountain span"></i> {{ main.title }}</h2>
        <div class="card shadow pl-5 pr-5">
          <div class="card-body">
            <div class="img">
              <img :src="'http://127.0.0.1:8000/show_image/main_' + main.image" class="shadow-lg">
            </div>

            <br>
            <div class="info">
              <div><span class="date right">Автор: {{main.author}}</span></div>
              <div><span class="date">Дата создания: {{main.created_at}}</span></div>
              <hr>
            <br>
            </div>

            <p class="text" style="white-space:pre-wrap; word-wrap:break-word;">{{ main.text }}</p>

            <p class="text" v-html="main.body"></p>
            <hr>
            <nuxt-link :to="`/articles/${ main.id-1 }`" class="btn btn-success"> <i class="fas fa-arrow-left"></i></nuxt-link>

            <nuxt-link :to="`/articles/${ main.id+1 }`" class="btn btn-success right"><i class="fas fa-arrow-right"></i></nuxt-link>

            <br><br><br>

            <section>
                <h2><i class="fas fa-comments"></i> Комментарии</h2>
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Имя:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ваше имя">

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Сообщение:</label>
                    <textarea class="form-control" placeholder="текст сообщения"></textarea>
                  </div>

                  <button type="submit" class="btn button"><i class="fas fa-share-square"></i> Отправить</button>
                </form>
          </section>
          </div>

        </div>
        <br><br><br><br>
        <h2><i class="fas fa-fire-alt"></i>&nbsp;Похожие статьи</h2>
        <hr size="10px" color="#29a137">


    <div class="row new">
      <div class="col_35 data shadow mb-5 pl-3 pr-3 pb-3 " v-for="article in new_articles" :key="`new-${article.id}`">

        <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="mr-5 pr-5 ">
          <div>
            <img :src="'http://127.0.0.1:8000/show_image/thumb_main_' + article.image">

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
  <br><br>

      </div>
      <br><br>
    </div>
  </div>

</template>

<script>

export default {
  data() {
    return {
      main: [],
      new_articles: [],

    };
  },
mounted() {
   if ($(window).width() <= '995') {
    const b = $("img").attr("width", "200px");
   }else {
     const b = $("img").attr("width", "600px");
   }

    },
  async asyncData({$axios, params}) {
    const data = await $axios.$get(`/articles/${params.id}`)
    return {
      main: data.main,
      new_articles: data.new,
    }
  },
 computed: {
   tag: function({$route}) {
      return this.$store.state.tags.tags
      .find(tag => {
        return tag.id == $route.params.id;
      });
    },
    new_page_items: function() {
      return this.new_articles.slice(
        this.num_per_page * this.page,
        this.num_per_page * (this.page + 1)
      );
    },
  },
  methods: {
    new_set_page: function(num) {
      this.page =  this.page + (num)
    }
  },
};

</script>

<style scoped>

  .right {
    float: right;
  }

  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
    transition: 1s;
  }

   img:hover {
    transform: scale(1.1);
    transition: 1s;
  }

  .link-hover:hover {
    opacity: 0.75;
  }

  .inline {
    display: inline-block;
  }

   .data {
    background-color: #f8f8f8;
    border: 15px solid white;
    font-size: 12;
  }
  .data:hover {
    background: #f1f1f1;
  }
  .col_35 {
  width: 30%;
flex-wrap: wrap;
}
  h2 {
    text-align: center;
    color: #352c26;
    background: #ccc;
  }

  a{
    color:#29a137;
    text-decoration: none;
  }

  a:hover {
    color: #352c26;
  }

  .info {
    color: #5f5549;
    font-style: italic;
  }

  .btn {
    color: #fff;
    border-radius: 0;
  }

  .img {
    display: flex;
    justify-content: center;

  }

  p {
    text-align: justify;
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

  .new {
  justify-content: space-around;
flex-wrap: wrap;


}

p[data-v-ee0c14b8] {
    width: 300px;
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

}

</style>