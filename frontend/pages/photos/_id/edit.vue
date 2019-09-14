<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Редактирование слайда:</h3>
    <form @submit.prevent="update">
      <div class="form-group">
        <label>Название</label>
        <input type="text" class="form-control" v-model="photo.title" placeholder="Пожалуйста, введите название" autofocus>
        <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
      </div>

      <div class="form-group mt-5">
        <label><i class="fas fa-cloud-upload-alt"></i>  Изображение </label>
        <div>
        <input type="file" @change="onUpload">
        </div>
        <small v-if="errors.image" class="form-text text-danger">{{errors.image[0]}}</small>
      </div>

      <button class="btn btn-success"><i class="fas fa-save"></i>   Сохранить</button>
    </form>

  </div>
</template>

<script>
export default {
  layout: 'admin',
  data() {
    return {
     photo: {
         id: '',
         title: '',
         image: '',
      },
      before_img: '',
    };
  },
  async asyncData({$axios, params}) {
    const data = await $axios.$get(`/photos/${params.id}`)
    return {
      photo: data.main,
      before_img: data.main.image
    }
  },

  methods: {
    onUpload (event) {
      this.photo.image = event.target.files[0]
    },

    update() {
      let config = {
        headers: {
          'content-type': 'multipart/form-data',
        },
      };
      config.headers['X-HTTP-Method-Override'] = 'PUT';

      let formData = new FormData()
      formData.append('title', this.photo.title)
      if(this.photo.image != this.before_img){
        formData.append('image', this.photo.image);
      }

      this.$axios.post(`/photos/${this.$route.params.id}`, formData, config)
      .then((response) => {
        console.log(this.photo);
         this.noti_save()
        this.$router.push("/photos/list_photos");
      })
      .catch((error) => {
         this.noti_error()
        console.log(error);
      });
    },

    async deletePhoto(id) {
      await this.$axios.$delete(`/photos/${id}`)
      this.$router.push("/photos/list_photos")
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
};
</script>
