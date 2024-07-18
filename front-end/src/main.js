import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";

// styles

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";
import "@/assets/styles/index.css";

// mouting point for the whole app
import App from "@/App.vue";

// layouts
import Topics from "@/layouts/Topics.vue";

import Categories from "@/views/topics/Categories.vue";
import Articles from "@/views/topics/Articles.vue";
import Article from "@/views/topics/Article.vue";
import CreateArticle from "@/views/topics/CreateArticle.vue";

import Admin from "@/layouts/Admin.vue";
import Auth from "@/layouts/Auth.vue";
import User from "@/layouts/User.vue";

// views for Admin layout
import Settings from "@/views/admin/Settings.vue";

// views for Auth layout
import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";

//views for User layout
import Profile from "@/views/user/Profile.vue";

// routes
const routes = [
  {
    path: "/admin",
    redirect: "/admin/dashboard",
    component: Admin,
    children: [
      {
        path: "/admin/settings",
        component: Settings,
      }
    ],
  },
  {
    path: "/auth",
    redirect: "/auth/login",
    component: Auth,
    children: [
      {
        path: "/auth/login",
        component: Login,
      },
      {
        path: "/auth/register",
        component: Register,
      },
    ],
  },
  {
    path: "/user",
    component: User,
    children: [
      {
        path: "/user/profile",
        component: Profile,
      }
    ],
  },
  {
    path: '/topics',
    component: Topics,
    children: [
      {
        path: '/topics/categories',
        component: Categories
      },
      {
        path: '/topics/category/:id/articles',
        component: Articles
      },
      {
        path: '/topics/article/:slug',
        component: Article
      },
      {
        path: '/topics/category/:id/create-article',
        component: CreateArticle
      }
    ]
  },
  {
    path: "/",
    redirect: "/topics/categories"
  },
  { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const sessionToken = sessionStorage.getItem('token');

  if (to.path.includes('/auth') && sessionToken) {
    next('/topics/categories');
  }

  next();
});

createApp(App).use(router).mount("#app");
