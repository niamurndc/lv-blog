<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/">CD Blog</router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/">Articles</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/popular">Popular</router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
            <div class="dropdown-menu" aria-labelledby="dropdown07">
              <router-link class="dropdown-item" v-for="cat in category" :key="cat.id" v-bind:to="{name: 'Category', params: {cat_id: cat.id}}">{{cat.name}}</router-link>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search">
        </form>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navabr',
  data(){
    return{
      category: []
    }
  },

  created(){
    axios.get(`http://127.0.0.1:8000/api/category`)
      .then(doc => {
        this.category = doc.data
        console.log(this.category)
      })
      .catch(err => console.log(err))
  }
}
</script>