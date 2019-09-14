<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">
    <h3>Создание слайда:</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label>Название</label>
        <input v-bind:style="titleError" type="text" class="form-control" v-model="form.title" placeholder="Пожалуйста, введите название" autofocus>
        <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
      </div>
      <div class="Image-input__image-wrapper">
            <i v-show="! imageSrc" class="icon fa fa-picture-o"></i>
            <img v-show="imageSrc" class="Image-input__image" :src="imageSrc">
        </div>

      <div class="form-group mt-5">
        <label><i class="fas fa-cloud-upload-alt"></i>  Изображение </label>
        <div>
        <input v-bind:style="imageError" type="file" @change="onUpload" class="form-text text-danger">
        </div>
        <small v-if="errors.image" class="form-text text-danger">{{errors.image[0]}}</small>
      </div>

    <button class="btn btn-success"><i class="fas fa-save"></i>   Сохранить</button>

    </form>
    <br>

  </div>
</template>

<script>
export default {
    props: [ 'imageSrc' ],
    layout: 'admin',
  data() {
    return {
      form: {
        title: '',
        image: '',
      },

    };
  },
  methods: {
    onUpload (event) {
      this.form.image = event.target.files[0]
      let input = event.target;

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = function(e) {
                    vm.imageSrc = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
    },
    submit() {
      const formData = new FormData()
      formData.append('title', this.form.title)
      formData.append('image', this.form.image)
      this.$axios
      .$post("photos", formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(data => {
        console.log(this.form);
        this.noti_save()
        this.$router.push("/photos/list_photos");
      })
      .catch(err => {
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
    titleError: function() {
      return {
        border: !!this.errors.title ? '1px solid red' : ''
      }
    },

    imageError: function() {
      return {
        border: !!this.errors.image ? '1px solid red' : ''
      }
    },
  }
};
</script>

