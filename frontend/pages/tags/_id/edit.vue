<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Редактирование тегa:</h3>
    <form @submit.prevent="update">
      <div class="form-group">
        <label>Имя тега</label>
        <input v-bind:style="nameError" type="text" class="form-control" v-model="tag.name" placeholder="Пожалуйста, введите имя тега" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
      </div>
      <button class="btn btn-success"><i class="fas fa-save"></i>   Сохранить</button>
    </form>

    <br>

  </div>
</template>

<script>
export default {
  layout: 'admin',
  data() {
    return {
      tag: {
        name: ''
      }
    };
  },
  async asyncData({$axios, params}){
    const {data} = await $axios.$get(`/tags/${params.id}`)
    return {
      tag: data
    }
  },
  methods: {
    update() {
      this.$axios.$patch(`/tags/${this.$route.params.id}`, {name: this.tag.name})
      .then(data=> {
          console.log(this.tag);
        this.noti_save()
        this.$router.push("/tags");
      }).catch(err => {
           this.noti_error()
        console.log(err);
      });
    },

    deleteTag(id) {
      this.$axios.$delete(`/tags/${id}`);
      this.$router.push('/tags');
    }
  },
  notifications: {
      noti_save: {
        title: 'Save',
        message: 'Cохранено',
        type: 'success'
      },
     noti_error: {
        title: 'noti_error',
        message: 'Есть ошибки',
        type: 'error'
      }
  },
  computed: {
    nameError: function() {
      return {
        border: !!this.errors.name ? '1px solid red' : ''
      }
    },
  }
};
</script>
