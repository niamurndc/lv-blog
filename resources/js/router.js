import Vue from 'vue'
import VueRouter from 'vue-router'
import AllPost from './components/AllPost'
import Author from './components/Author'
import Post from './components/Post'
import Category from './components/Category'

Vue.use(VueRouter)

const routes = [
    {
      path: '/',
      name: 'AllPost',
      component: AllPost
    },
    {
      path: '/:author_id/author',
      name: 'Author',
      component: Author
    },
    {
      path: '/post/:id',
      name: 'Post',
      component: Post
    },
    {
      path: '/category/:cat_id',
      name: 'Category',
      component: Category
    }
];

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router