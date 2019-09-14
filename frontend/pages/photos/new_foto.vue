<template>
  <div class="container">

    <h2><i class="fas fa-images"></i>&nbsp;Галерея</h2>
  <hr size="10px" color="#29a137">

    <div class="inline">
      <div class="line" v-for="photo in new_photos" :key="`new-${photo.id}`">
        <a :href="'http://127.0.0.1:8000/show_image/' + photo.image" data-fancybox="gallery" :data-caption="photo.title">
        <img :src="'http://127.0.0.1:8000/show_image/thumb_main_' + photo.image">
        </a>
      </div>
    </div>

    <br><br>

  </div>
</template>

<script>
export default {
  data() {
    return {
      new_photos: [],
      page: 0,
      num_per_page: 6
    };
  },
  async asyncData({$axios}) {
    const {data} = await $axios.$get('new_foto')
    return {
      new_photos: data
    }
  },
  computed: {
    new_page_items: function() {
      return this.new_photos.slice(
        this.num_per_page * this.page,
        this.num_per_page * (this.page + 1)
      );
    }
  },
  methods: {
    set_page: function(num) {
      this.page =  this.page + (num)
    }
  },
  filters: {
    truncate: function(value, limit) {
      if (value.length > limit) {
        value = value.substring(0, (limit - 3)) + '...';
      }
      return value
    }
  }
};
</script>

<style scoped>
  .inline {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    flex-direction: row-reverse;
  }
  .line {
    width: 20%;
  }
  img {
    width:auto;
    height:auto;
    max-width:100%;
    max-height:100%;
  }

  .data {
    background-color: #f8f8f8;
    border: 10px solid white;
  }

  .data:hover {
    opacity: 0.75 ;
  }

  .pagination {
    display: inline-block;
  }

  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
  }

  .pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
  }

  .pagination a:hover:not(.active) {background-color: #ddd;}

</style>
