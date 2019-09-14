<template>

  <div class="container col-md-9 mt-5">
<h2>
 {{ cat.name }}
</h2>

<p>Описание - {{ cat.description }}</p>
<p>Родитель - {{ cat.parent_id }}</p>
<p>Меню - {{ cat.menu }}</p>
<p>Опубликовано - {{ cat.status }}</p>
  </div>

</template>

<script>

export default {
  data() {
    return {
      cat: [],
    };
  },

  async asyncData({$axios, params}) {
    const data = await $axios.$get(`/categories/${params.id}`)
    return {
      cat: data.cat,
    }
  },


};

</script>

<style scoped>

  .right {
    float: right;
  }

  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
    transition: 1s;
  }

   img:hover {
    transform: scale(1.1);
    transition: 1s;
  }

  .link-hover:hover {
    opacity: 0.75;
  }

  .inline {
    display: inline-block;
  }

   .data {
    background-color: #f8f8f8;
    border: 15px solid white;
    font-size: 12;
  }
  .data:hover {
    background: #f1f1f1;
  }
  .col_35 {
  width: 30%;
flex-wrap: wrap;
}
  h2 {
    text-align: center;
    color: #352c26;
    background: #ccc;
  }

  a{
    color:#29a137;
    text-decoration: none;
  }

  a:hover {
    color: #352c26;
  }

  .info {
    color: #5f5549;
    font-style: italic;
  }

  .btn {
    color: #fff;
    border-radius: 0;
  }

  .img {
    display: flex;
    justify-content: center;

  }

  p {
    text-align: justify;
  }

   .button {
    background: #29a137;
    padding: 10px;
    color: #fff;
    text-align: center;
    display: inline-block;
    width: 200px;
    float: right;
    transition: 1s;
    text-decoration: none;
  }

  .button:hover {
    background: #5f5549;
    transition: 1s;
  }

  .new {
  justify-content: space-around;
flex-wrap: wrap;


}

p[data-v-ee0c14b8] {
    width: 300px;
  }
@media screen and (max-width: 1200px) {

 .col_35 {
  width: 50%;
  text-align: center;
  }
}

@media screen and (max-width: 768px) {

 .col_35 {
  width: 90%;
  text-align: center;
  }

}

</style>