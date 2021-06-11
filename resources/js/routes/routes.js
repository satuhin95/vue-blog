import Home from '../components/backend/Home'
// category 
import Category from '../components/backend/category/index'
import CategoryAdd from '../components/backend/category/Create'
import CategoryEdit from '../components/backend/category/Edit'
// post 
import Post from '../components/backend/post/index'
import PostAdd from '../components/backend/post/Create'
import PostEdit from '../components/backend/post/Edit'

// frontend 

import Index from '../components/frontend/Home'
import About from '../components/frontend/About'
import CategoryPost from '../components/frontend/Category'
import PostDetails from '../components/frontend/PostDetails'

export const routes = [
    { path: '/home', component: Home },
    { path: '/category', component: Category },
    { path: '/category-add', component: CategoryAdd },
    { path: '/category-edit/:id', component: CategoryEdit },

    // post 
    { path: '/post', component: Post },
    { path: '/post-add', component: PostAdd },
    { path: '/post-edit/:id', component: PostEdit },


    // forntend 

    { path: '/', component: Index },
    { path: '/about', component: About },
    { path: '/category/:slug', component: CategoryPost },
    { path: '/post/:slug', component: PostDetails },
  ];