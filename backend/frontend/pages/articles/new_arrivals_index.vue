<template>
  <div class="container">
<br><br>
   <h2><i class="fas fa-newspaper"></i>&nbsp;Новые статьи</h2>
    <hr size="10px" color="#29a137">

        <div class="row new">
      <div class="col_6 data shadow mb-5 pl-5 pr-5" v-for="article in new_articles" :key="`new-${article.id}`">

        <nuxt-link :to="{name:'articles-id',params:{id:article.id}}" class="mr-5 pr-5 ">
          <div>
            <img class="treug img" :src="'http://127.0.0.1:8000/show_image/thumb_main_' + article.image">

          </div>
        </nuxt-link>

         <h3><i class="fab fa-ethereum"></i> {{ article.title }}</h3>
            <p v-html="article.text"></p>
              <nuxt-link :to="{name:'articles-id',params:{id:article.id}}">
          <div class="right button">
            подробнее <i class="fas fa-hand-point-right"></i>
          </div>
        </nuxt-link>
      </div>
    </div>
<br><br>

    <div class="text-center">
      <div class="pagination">
        <a v-if="(page-1)>=0" v-on:click="set_page(-1)">&laquo;</a>
        <a v-if="(page-2)>=0" v-on:click="set_page(-2)">{{page-1}}</a>
        <a v-if="(page-1)>=0" v-on:click="set_page(-1)">{{page}}</a>
        <a class="active" v-if="new_articles.length>=num_per_page">{{page+1}}</a>
        <a v-if="(this.num_per_page) * (this.page+1) < this.new_articles.length" v-on:click="set_page(+1)">{{page+2}}</a>
        <a v-if="(this.num_per_page) * (this.page+2) < this.new_articles.length" v-on:click="set_page(+2)">{{page+3}}</a>
        <a v-if="(this.num_per_page) * (this.page+1) < this.new_articles.length" v-on:click="set_page(+1)">&raquo;</a>
      </div>
    </div>
<br><br>
  </div>
</template>

<script>
export default {
  data() {
    return {
      new_articles: [],
      page: 0,
      num_per_page: 6
    };
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get('new_arrivals_index')
    return {
      new_articles: data
    }
  },
  computed: {
    new_page_items: function() {
      return this.new_articles.slice(
        this.num_per_page * this.page,
        this.num_per_page * (this.page + 1)
      );
    }
  },
  methods: {
    set_page: function(num) {
      this.page =  this.page + (num)
    }
  },

  filters: {
    truncate: function(value, limit) {
      if (value.length > limit) {
        value = value.substring(0, (limit - 3)) + '...';
      }
      return value
    }
  }
};
</script>

<style scoped>
  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
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

  .pagination a:hover:not(.active) {background-color: #ddd;}

    .data {
    background-color: #f8f8f8;
    border: 15px solid white;
    width: 45%;
  text-align: center;
  }
  .data:hover {
    background: #f1f1f1;
  }

  .data p {
    text-align: justify;
  }

  .new {
    justify-content: space-around;
  }

  .treug {
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    transition: 2s;
  }

  .treug:hover {
    transition: 2s;
   clip-path: polygon(0 0, 100% 0%, 100% 100%, 0% 100%);
  }
.button {
    background: #29a137;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 200px;
    transition: 1s;
    text-decoration: none;
  }

  .button:hover {
    background: #5f5549;
    transition: 1s;
  }
@media screen and (max-width: 1100px) {

 .col_6 {
  width: 90%;

  }
}

@media screen and (max-width: 768px) {


}
</style>
