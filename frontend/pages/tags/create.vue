<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Создание тега:</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label>Имя тега</label>
        <input v-bind:style="nameError" type="text" class="form-control" v-model="form.name" placeholder="Пожалуйста, введите имя тега" autofocus>
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
        name:''
      }
    };
  },
  methods: {
    submit() {
      this.$axios.$post("tags", this.form)
      .then(data => {
        console.log(this.form);
        this.noti_save()
        this.$router.push('/tags');

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
