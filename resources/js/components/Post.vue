<template>
  <div>
    <div class="row mt-2">
      <div class="col-md-5 meta-text">
        <div>
          <p @click="getCat(post.cat_id)"><strong class="text-primary">{{post.category}}</strong></p>
          <h1>{{post.title}}</h1>
        </div>
        <div>
          <strong v-on:click="getAuthor(post.author_id)">{{post.author}}</strong><br>
          <span>{{post.published}}</span> <span>Read: {{post.read}}</span> 
        </div>
      </div>
      <div class="col-md-7">
        <img v-bind:src="'http://127.0.0.1:8000/image/post-cover/'+post.cover" width="100%" height="360px">
      </div>
    </div>
    <hr>
    <div v-html="post.body" class="body-text"></div>
  </div>
</template>

<script>
export default {
  name: 'Post',
  data(){
    return{
      post: {},
      post_id: this.$route.params.id
    }
  },
  methods: {
    getAuthor(id){
      console.log(id)
      this.$router.push({name: 'Author', params: {author_id: id}});
    },

    getCat(id){
      console.log(id)
      this.$router.push({name: 'Category', params: {cat_id: id}});
    }
  },
  created(){
    axios.get(`http://127.0.0.1:8000/api/post/${this.post_id}`)
      .then(doc => {
        this.post = doc.data.data
      })
  }
}
</script>

<style scoped>
.meta-text{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.body-text{
  font-size: 18px;
}
</style>