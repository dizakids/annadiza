<template>
  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Создание статьи:</h3>

    <form @submit.prevent="submit">

      <div class="form-group">
        <label>Название</label>
        <input v-bind:style="titleError" type="text" class="form-control" v-model="form.title" placeholder="Пожалуйста, введите название" autofocus>
        <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
      </div>

      <div class="form-group">
        <label>Категория:</label>
        <select v-bind:style="category_idError" class="form-control" v-model="form.category_id">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <small v-if="errors.home" class="form-text text-danger">{{errors.home[0]}}</small>
      </div>

<div class="form-group">
        <label>Размещение:</label>
        <select v-bind:style="homeError" class="form-control" v-model="form.home">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>home</option>
          <option>no</option>
        </select>
        <small v-if="errors.home" class="form-text text-danger">{{errors.home[0]}}</small>
      </div>

      <div class="form-group">
        <label>Автор</label>
        <input v-bind:style="authorError" type="text" class="form-control" v-model="form.author" placeholder="Пожалуйста, введите автора" autofocus>
        <small v-if="errors.author" class="form-text text-danger">{{errors.author[0]}}</small>
      </div>

        <div class="form-group">
        <label>Опубликовано:</label>
        <select v-bind:style="statusError" class="form-control" v-model="form.status">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>true</option>
          <option>false</option>
        </select>
        <small v-if="errors.status" class="form-text text-danger">{{errors.status[0]}}</small>
      </div>

        <div class="form-group mt-5">
        <label>Краткое описание:</label>
        <textarea v-bind:style="textError" class="form-control" v-model="form.text" placeholder="Краткое описание" cols="50" rows="6"></textarea>
        <small v-if="errors.text" class="form-text text-danger">{{errors.text[0]}}</small>
      </div>

      <div class="form-group mt-5">
        <label>Текст статьи</label>
        <div class="quill-editor"
           :content="content"
           @change="onEditorChange($event)"
           @blur="onEditorBlur($event)"
           @focus="onEditorFocus($event)"
           @ready="onEditorReady($event)"
           v-quill:myQuillEditor="editorOption"
           v-model="form.body">
        </div>
        <small v-if="errors.body" class="form-text text-danger">{{errors.body[0]}}</small>
      </div>

      <div class="Image-input__image-wrapper">
            <i v-show="! imageSrc" class="icon fa fa-picture-o"></i>
            <img v-show="imageSrc" class="Image-input__image" :src="imageSrc">
      </div>

      <div class="form-group mt-5">
        <label><i class="fas fa-cloud-upload-alt"></i>  Изображение </label>
        <div>
          <input v-bind:style="imageError" type="file" @change="onUpload">
        </div>
        <small v-if="errors.image" class="form-text text-danger">{{errors.image[0]}}</small>
      </div>

      <div class="form-group mt-5">
        <p>Список тегов:</p>
        <span v-for="tag in $store.state.tags.tags" :key="tag.id">
          <input type="checkbox" :value="tag.id" :id="tag.id" v-model="form.tags" >
          <label :for="tag.id">{{tag.name}}</label><br>
        </span>
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
        body: '',
        tags: [],
        image: '',
        text: '',
        author: '',
        status: '',
        home: '',
        category_id: '',
      },
      content: 'I am Example',
        editorOption: {
          modules: {
        //    imageResize: {
        //   displaySize: true
        // },
           toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              ['blockquote', 'code-block'],
              [{ 'header': 1 }, { 'header': 2 }],
              [{ 'list': 'ordered' }, { 'list': 'bullet' }],
              [{ 'script': 'sub' }, { 'script': 'super' }],
              [{ 'indent': '-1' }, { 'indent': '+1' }],
              [{ 'direction': 'rtl' }],
              [{ 'size': ['small', false, 'large', 'huge'] }],
              [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
              [{ 'font': [] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'align': [] }],
              ['clean'],
              ['link', 'image', 'video']
            ],

        }}

    }
  },

  mounted() {
      console.log('app init, my quill insrance object is:', this.myQuillEditor)
      setTimeout(() => {
        this.content = 'i am changed'
      }, 3000)
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
      formData.append('body', this.form.body)
      formData.append('text', this.form.text)
      formData.append('status', this.form.status)
      formData.append('home', this.form.home)
      formData.append('author', this.form.author)
      formData.append('image', this.form.image)
      formData.append('tags', this.form.tags)
      formData.append('category_id', this.form.category_id)
      this.$axios
      .$post("articles", formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(data => {
        console.log(this.form);
        this.noti_save()
        this.$router.push("/articles/list_articles");
      })
      .catch(err => {
        this.noti_error()
        console.log(err);
      });
    },
     onEditorBlur(editor) {
        console.log('editor blur!', editor)
      },
      onEditorFocus(editor) {
        console.log('editor focus!', editor)
      },
      onEditorReady(editor) {
        console.log('editor ready!', editor)
      },
      onEditorChange({ editor, html, text }) {
        //console.log('editor change!', editor, html, text)
        this.content = html
      }
  },
  computed: {
    titleError: function() {
      return {
        border: !!this.errors.title ? '1px solid red' : ''
      }
    },
    bodyError: function() {
      return {
        border: !!this.errors.body ? '1px solid red' : ''
      }
    },
      textError: function() {
      return {
        border: !!this.errors.text ? '1px solid red' : ''
      }
    },
      authorError: function() {
      return {
        border: !!this.errors.author ? '1px solid red' : ''
      }
    },
     statusError: function() {
      return {
        border: !!this.errors.status ? '1px solid red' : ''
      }
    },
    homeError: function() {
      return {
        border: !!this.errors.home ? '1px solid red' : ''
      }
    },
    category_idError: function() {
      return {
        border: !!this.errors.home ? '1px solid red' : ''
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

<style>
  .quill-editor {
    height: 300px;
  }


</style>

