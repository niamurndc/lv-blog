<template>
  <div>
    <div class="jumbotron">
      <div class="row">
        <div class="col-md-9">
          <h1>{{author.name}}</h1>
          <p class="lead">{{author.description}}</p>
        </div>
        <div class="col-md-3">
          <h2>{{posts.length}} Articles</h2>
        </div>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-3" v-for="post in posts" :key="post.id">
        <div class="card my-2">
          <img v-bind:src="'http://127.0.0.1:8000/image/post-cover/'+post.cover" class="card-img-top main-img">
          <div class="card-body">
            <h5>{{ post.title}}</h5>
            <span>{{post.published}}</span> |
            <span>Read: {{post.read}}</span> | 
            <span v-on:click="navigateSingle(post.id)">View Post</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Author',
  data(){
    return{
      author_id: this.$route.params.author_id,
      posts: [],
      author: {},
      //articles: posts.length
    }
  },

  methods: {
    navigateSingle(id){
      this.$router.push({name: 'Post', params: {id: id}})
    }
  },

  created(){
    axios.get(`http://127.0.0.1:8000/api/author/${this.author_id}`)
      .then(doc => {
        this.posts = doc.data.data
      })
      .catch(err => console.log(err))
    
    axios.get(`http://127.0.0.1:8000/api/author/profile/${this.author_id}`)
      .then(auht => {
        this.author = auht.data
      })
      .catch(err => console.log(err))
  }
}
</script>


<style scoped>
.main-img{
  height: 165px;
}

.jumbotron{
  padding: 30px;
}
</style>