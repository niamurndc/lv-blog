<template>
  <div>
    <h1>All Posts</h1>
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
  name: 'AllPost',
  data(){
    return{
      posts: []
    }
  },
  methods: {
    navigateSingle(id){
      this.$router.push({name: 'Post', params: {id: id}})
    }
  },
  created(){
    axios.get('http://127.0.0.1:8000/api/post')
      .then(doc => {
        this.posts = doc.data.data
      })
      .catch(err => console.log(err))
  }
}
</script>

<style scoped>
.main-img{
  height: 165px;
}
</style>