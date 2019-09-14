<template>

  <div class="container col-md-6 mt-5" v-if="authenticated && user.admin">

    <h3>Редактирование статьи:</h3>
    <form @submit.prevent="update">

      <div class="form-group">
        <label>Название</label>
        <input type="text" class="form-control" v-model="article.title" placeholder="Пожалуйста, введите название" autofocus>
        <small v-if="errors.title" class="form-text text-danger">{{errors.title[0]}}</small>
      </div>

 <div class="form-group">
        <label>Категория:</label>
        <select class="form-control" v-model="article.category_id">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>

       <div class="form-group">
        <label>Размещение:</label>
        <select class="form-control" v-model="article.home">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>home</option>
          <option>no</option>
        </select>

      </div>

   <div class="form-group">
        <label>Опубликовано:</label>
        <select class="form-control"v-model="article.status">
          <option disabled value="">Пожалуйста, выберите</option>
          <option>true</option>
          <option>false</option>
        </select>
      </div>

     <!--    <div class="form-group">
        <label>Опубликовано:</label>

        <input class="form-control" v-model="article.status" autofocus>
<small v-if="errors.status" class="form-text text-danger">{{errors.status[0]}}</small>
      </div> -->


      <div class="form-group">
        <label>Автор</label>
        <input type="text" class="form-control" v-model="article.author" placeholder="Пожалуйста, введите название" autofocus>
        <small v-if="errors.author" class="form-text text-danger">{{errors.author[0]}}</small>
      </div>

    <div class="form-group mt-5">
        <label>Краткое описание:</label>
        <textarea class="form-control" v-model="article.text" placeholder="Краткое описание" cols="50" rows="5"></textarea>
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
         v-model="article.body">
      </div>
      <small v-if="errors.body" class="form-text text-danger">{{errors.body[0]}}</small>
    </div>

      <div class="form-group mt-5">
        <label><i class="fas fa-cloud-upload-alt"></i>  Изображение </label>
        <div>
        <input type="file" @change="onUpload">
        </div>
        <small v-if="errors.image" class="form-text text-danger">{{errors.image[0]}}</small>
      </div>

      <div class="form-group mt-5 ">
        <p>Список тегов:</p>
        <span v-for="tag in $store.state.tags.tags" :key="tag.id">
          <input type="checkbox" :value="tag.id" :id="tag.id" v-model="article.tags">
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
layout: 'admin',
  data() {
    return {
      article: {
         id: '',
         title: '',
         body: '',
         image: '',
         tags: [],
         text: '',
         author: '',
         status:'',
         home:'',
         category_id:'',
      },
      before_img: '',
      content: 'Текст статьи',
        editorOption: {
          modules: {
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
          }
        }
    }
  },
  async asyncData({$axios, params}) {
    const data = await $axios.$get(`/articles/${params.id}`)
    return {
      article: data.main,
      before_img: data.main.image
    }
  },
  mounted() {
      console.log('app init, my quill insrance object is:', this.myQuillEditor)
      setTimeout(() => {
        this.content = 'i am changed'
      }, 3000)
    },
  methods: {
    onUpload (event) {
      this.article.image = event.target.files[0]

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
      },
    update() {
      let config = {
        headers: {
          'content-type': 'multipart/form-data',
        },
      };
      config.headers['X-HTTP-Method-Override'] = 'PUT';

      let formData = new FormData()
      formData.append('title', this.article.title)
      formData.append('body', this.article.body)
      formData.append('text', this.article.text)
      formData.append('author', this.article.author)
      formData.append('status', this.article.status)
      formData.append('home', this.article.home)
      formData.append('category_id', this.article.category_id)
      if(this.article.image != this.before_img){
        formData.append('image', this.article.image)
      }
      formData.append('tags', this.article.tags)

      this.$axios.post(`/articles/${this.$route.params.id}`, formData, config)
      .then((response) => {
        console.log(this.article);
        this.noti_save()
        this.$router.push("/articles/list_articles");
      })
      .catch((error) => {
        this.noti_error()
        console.log(error);
      });
    },

  async deleteArticle(id) {
      await this.$axios.$delete(`/articles/${id}`)
      this.$router.push("/articles/list_articles")
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
