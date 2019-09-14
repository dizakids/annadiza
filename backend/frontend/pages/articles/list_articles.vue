<template>
  <div class="container" v-if="authenticated && user.admin">

    <h2>Список статей:</h2>
    <div>
      <table class="table table-hover">
      <thead>
          <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Изобраение</th>
                  <th>Статус</th>
              <th>На главной</th>
              <th>Категория</th>
              <th>Действия</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="article in new_page_items" :key="article.id">
              <td>{{ article.id }}</td>
              <td>{{ article.title }}</td>

              <td> <img :src="'http://127.0.0.1:8000/show_image/thumb_sub_' + article.image"></td>
                <td>{{ article.status }}</td>
              <td>{{ article.home }}</td>
              <td>{{ article.category_id }}</td>
              <td>

                  <nuxt-link :to="{name:'articles-id-edit',params:{id:article.id}}" class="btn btn-info"><i class="far fa-edit"></i></nuxt-link>
                  &nbsp;

                  <button class="btn btn-danger"@click="deleteArticle(article.id)"><i class="fas fa-trash-alt"></i></button>
              </td>
          </tr>
      </tbody>
      </table>
    </div>

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

  </div>
</template>

<script>
export default {
  layout: 'admin',
  data() {
    return {
     new_articles: [],
     page: 0,
     num_per_page: 4,
    }
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get('list_articles');
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
    },
    async deleteArticle(id) {
       alert("Вы хотите удалить ?");
      await this.$axios.$delete(`/articles/${id}`)
      // this.$router.push('/articles/list_articles')
      // location.reload()
      // this.$router.go()
      this.noti_del()
      window.location.reload(true);
    }
  },
  notifications: {
      noti_del: {
        title: 'del',
        message: 'Удалено',
        type: 'success'
      },
  },
};
</script>

<style scoped>
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
    opacity: 0.75 ;
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



</style>
