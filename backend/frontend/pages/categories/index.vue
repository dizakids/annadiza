<template>
  <div class="container" v-if="authenticated && user.admin">
    <h2>Cписок категорий:</h2>
    <div>
      <table class="table table-hover">
      <thead>
          <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Родитель</th>
              <th>Путь</th>
              <th>Меню</th>
              <th>Опубликовано</th>
              <th>Описание</th>
              <th>Действия</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>{{ category.parent_id }}</td>
            <td>{{ category.path }}</td>
            <td>{{ category.menu }}</td>
            <td>{{ category.status }}</td>
            <td>{{ category.description }}</td>
            <td>
                <nuxt-link :to="{name:'categories-id-edit',params:{id:category.id}}" class="btn btn-info"><i class="far fa-edit"></i></nuxt-link>
                &nbsp;
                <button class="btn btn-danger" @click="deleteCategory(category.id)"><i class="fas fa-trash-alt"></i></button>
            </td>
          </tr>
      </tbody>
      </table>
    </div>
  </div>

</template>

<script>
export default {
  layout: 'admin',
  data() {
    return {
      categories: []
    }
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get(`/categories`);
    return {
      categories: data
    }
  },
   methods: {
    async deleteCategory(id) {
     await this.$axios.$delete(`/categories/${id}`)
              alert("Вы хотите удалить категорию?");
              this.$router.push('/categories')
              this.noti_del()
              location.reload()
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
