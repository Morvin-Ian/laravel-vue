import { createRouter, createWebHistory } from 'vue-router'
import PostItems from '../components/PostItems.vue'
import PostItem from '../components/PostItem.vue'
import CategoryItems from '../components/CategoryItems'
import AuthorItems from '../components/AuthorItems'
import CreatePost from '../components/createPost'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: PostItems
  },
  {
    path: '/post/:id',
    name: 'post',
    component: PostItem
  },
  {
    path: '/category/:slug',
    name: 'category',
    component: CategoryItems
  },
  {
    path: '/author/:slug',
    name: 'author',
    component: AuthorItems
  },
  {
    path: '/create-post',
    name: 'create',
    component: CreatePost
  },
  {
    path: '/sign-in',
    name: 'login',
    component: LoginView
  },
  {
    path: '/sign-up',
    name: 'register',
    component: RegisterView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
