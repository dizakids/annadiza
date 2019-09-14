<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Создание категории:</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label>Имя категории</label>
        <input v-bind:style="nameError" type="text" class="form-control" v-model="form.name" placeholder="Пожалуйста, введите имя категории" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
      </div>


       <div class="form-group">
        <label>Описание</label>
        <input v-bind:style="nameError" type="text" class="form-control" v-model="form.description" placeholder="Пожалуйста, введите описание" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
 </div>

      <div class="form-group">
        <label>Путь</label>
        <input v-bind:style="nameError" type="text" class="form-control" v-model="form.path" placeholder="Пожалуйста, введите путь" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
      </div>

       <div class="form-group">
        <label>Родитель</label>
        <input v-bind:style="nameError" type="number" class="form-control" v-model="form.parent_id" placeholder="Пожалуйста, введите родителя" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
      </div>

        <div class="form-group">
        <label>Меню</label>
        <input v-bind:style="nameError" type="number" class="form-control" v-model="form.menu" autofocus>
        <small v-if="errors.name" class="form-text text-danger">{{errors.name[0]}}</small>
 </div>
        <div class="form-group">
        <label>Опубликовано</label>
        <input v-bind:style="nameError" type="number" class="form-control" v-model="form.status" placeholder="Пожалуйста, введите статус" autofocus>
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
      form: {
        name:'',
        path: '',
        status: '',
        description: '',
        menu: '',
        parent_id: '',
      }
    };
  },
  methods: {
    submit() {
      this.$axios.$post("categories", this.form)
      .then(data => {
        console.log(this.form);
        this.noti_save()
        this.$router.push('/categories');

      })
      .catch(err => {
          this.noti_error()
        console.log(err);
      });
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
