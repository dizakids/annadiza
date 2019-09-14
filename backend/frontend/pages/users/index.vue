<template>
  <div class="container" v-if="authenticated && user.admin">
    <h2>Пользователи</h2>
    <div>
      <table class="table table-hover">
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          <tr v-for="user in users" :key="user.id">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>

                  <nuxt-link :to="'users/'+user.id" class="btn btn-info">Show</nuxt-link>
                  &nbsp;
                   <nuxt-link :to="'users/'+user.id+ '/edit'" class="btn btn-info"><i class="far fa-edit"></i></nuxt-link>
                  &nbsp;
                  <button class="btn btn-danger" @click=""><i class="fas fa-trash-alt"></i></button>

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
        users: []
      }
    },
  async asyncData({$axios}) {
      const {data} = await $axios.$get(`/users`);
      return {
        users: data
      }
    },
};
</script>
