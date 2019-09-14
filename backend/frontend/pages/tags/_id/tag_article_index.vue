<template>
  <div class="container">

    <h6>Cтатьи категории:</h6>
    <h2>
     <i class="fab fa-ethereum"></i> {{tag.name}}
    </h2>
    <br>
    <hr size="5px">
    <div class="row">
      <div class="col-12 data shadow mb-5 p-3" v-for="article in new_page_items" :key="`new-${article.id}`">
        <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="link-border">
          <div>
            <img class="treug img" :src="'http://127.0.0.1:8000/show_image/thumb_main_' + article.image">
          </div>
        </nuxt-link>
            <div>
              <h3 class="article-title"> <i class="fas fa-mountain span"></i> {{ article.title }}</h3>
            <hr size="10px" color="#29a137" class="ml">
            <p v-html="article.text"></p>
   <div class="info">
              <div><span class="date right">Автор: {{article.author}}</span></div>
              <div><span class="date">Дата создания: {{article.created_at}}</span></div>

            </div>
            <br><br>
            <div class="text-right">
      <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="button shadow-lg">
        подробнее <i class="fas fa-hand-point-right"></i></i>
      </nuxt-link>
            </div>

    </div>

      </div>
    </div>

    <div class="text-center">
      <div class="pagination">
        <a v-if="(new_page-1)>=0" v-on:click="new_set_page(-1)">&laquo;</a>
        <a v-if="(new_page-2)>=0" v-on:click="new_set_page(-2)">{{new_page-1}}</a>
        <a v-if="(new_page-1)>=0" v-on:click="new_set_page(-1)">{{new_page}}</a>
        <a class="active" v-if="new_tag_articles.length>=new_num_per_page">{{new_page+1}}</a>
        <a v-if="(this.new_num_per_page) * (this.new_page+1) < this.new_tag_articles.length" v-on:click="new_set_page(+1)">{{new_page+2}}</a>
        <a v-if="(this.new_num_per_page) * (this.new_page+2) < this.new_tag_articles.length" v-on:click="new_set_page(+2)">{{new_page+3}}</a>
        <a v-if="(this.new_num_per_page) * (this.new_page+1) < this.new_tag_articles.length" v-on:click="new_set_page(+1)">&raquo;</a>
      </div>
    </div>

    <br><br><br><br>

  </div>
</template>

<script>
export default {
    data() {
      return {
        new_tag_articles: [],
        new_page: 0,
        new_num_per_page: 3,

      };
  },
  async asyncData({$axios, params}){
    const data = await $axios.$get(`/tags/${params.id}/tag_article_index`)
    return {
      new_tag_articles: data.new_tag_articles,

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
      return this.new_tag_articles.slice(
        this.new_num_per_page * this.new_page,
        this.new_num_per_page * (this.new_page + 1)
      );
    },
  },
  methods: {
    new_set_page: function(num) {
      this.new_page =  this.new_page + (num)
    },
  },

};
</script>

<style scoped>
.ml {
  margin-left: 38%;
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
h3 {
    color: #352c26;
    margin-top: 50px;
  }
  .button:hover {
    background: #5f5549;
    transition: 1s;
  }

 .treug {
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    transition: 2s;
  }

  .treug:hover {
    transition: 2s;
   clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 100%);
  }
  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
  }
  .data {
    background-color: #f8f8f8;
    border: 10px solid white;
  }
  .data:hover {
	  background: #f1f1f1;
  }

  .pagination {
    display: inline-block;
  }

  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
  }

  .pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
  }

  .pagination a:hover:not(.active) {
    background-color: #ddd;
  }

  h2 {
    text-align: center;
    color: #352c26;
    background: #ccc;

  }

.img {
  float: left;
  margin-right: 50px;
}
 .info {
    color: #5f5549;
    font-style: italic;
    font-size: 12px;
  }
@media screen and (max-width: 1200px) {


}

@media screen and (max-width: 768px) {

.ml {
  margin-left: 0;
}

}
  </style>
