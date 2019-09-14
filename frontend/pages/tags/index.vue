<template>
  <div class="container" v-if="authenticated && user.admin">
    <h2>Cписок тегов:</h2>
    <div>
      <table class="table table-hover">
      <thead>
          <tr>
              <th>ID</th>
              <th>Название</th>
              <th>Действия</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="tag in tags" :key="tag.id">
            <td>{{ tag.id }}</td>
            <td>{{ tag.name }}</td>
            <td>
                <nuxt-link :to="{name:'tags-id-edit',params:{id:tag.id}}" class="btn btn-info"><i class="far fa-edit"></i></nuxt-link>
                &nbsp;
                <button class="btn btn-danger" @click="deleteTag(tag.id)"><i class="fas fa-trash-alt"></i></button>
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
      tags: []
    }
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get(`/tags`);
    return {
      tags: data
    }
  },
   methods: {
    async  deleteTag(id) {
     await this.$axios.$delete(`/tags/${id}`)
              alert("Вы хотите удалить тег?");
              this.$router.push('/tags')
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
