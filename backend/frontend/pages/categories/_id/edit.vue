<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Редактирование категории:</h3>
    <form @submit.prevent="update">

      <div class="form-group">
        <label>Название</label>
        <input type="text" class="form-control" v-model="category.name">

      </div>

        <div class="form-group">
        <label>Описание</label>
        <input type="text" class="form-control" v-model="category.description">

 </div>

      <div class="form-group">
        <label>Путь</label>
        <input type="text" class="form-control" v-model="category.path">

      </div>

       <div class="form-group">
        <label>Родитель</label>
        <input type="number" class="form-control" v-model="category.parent_id">

      </div>

        <div class="form-group">
        <label>Меню</label>
        <input type="number" class="form-control" v-model="category.menu">

 </div>
        <div class="form-group">
        <label>Опубликовано</label>
        <input type="number" class="form-control" v-model="category.status">

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
      category: {
        name: '',
        path: '',
        status: '',
        description: '',
        menu: '',
        parent_id: '',
      }
    };
  },
  async asyncData({$axios, params}){
    const data = await $axios.$get(`/categories/${params.id}`)
    return {
      category: data.cat
    }
  },
  methods: {
    update() {
       let config = {
        headers: {
          'content-type': 'multipart/form-data',
        },
      };
      config.headers['X-HTTP-Method-Override'] = 'PUT';
       let formData = new FormData()
      formData.append('name', this.category.name)
      formData.append('parent_id', this.category.parent_id)
      formData.append('menu', this.category.menu)
      formData.append('description', this.category.description)
      formData.append('status', this.category.status)
      formData.append('path', this.category.path)

       this.$axios.post(`/categories/${this.$route.params.id}`, formData, config)
      .then((response) => {

          console.log(this.category);
        this.noti_save()
        this.$router.push("/categories");
      }).catch(err => {
           this.noti_error()
        console.log(err);
      });
    },
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
