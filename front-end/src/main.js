import { createApp, ref } from "vue";
import { createWebHistory, createRouter } from "vue-router";

// styles

import "@fortawesome/fontawesome-free/css/all.min.css";
import "@/assets/styles/tailwind.css";
import "@/assets/styles/index.css";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// mouting point for the whole app
import App from "@/App.vue";

// layouts
import Topics from "@/layouts/Topics.vue";

import Categories from "@/views/topics/Categories.vue";
import Articles from "@/views/topics/Articles.vue";
import Article from "@/views/topics/Article.vue";
import CreateArticle from "@/views/topics/CreateArticle.vue";
import EditArticle from "@/views/topics/EditArticle.vue";

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
        path: '/topics/aticle/:slug/edit-article',
        component: EditArticle
      },
      {
        path: '/topics/category/:id/create-article',
        component: CreateArticle
      },
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

  if (to.path.includes('profile') && !sessionToken) {
    next('/auth/login');
  }

  next();
});

const app = createApp(App);

const globalState = {
  loggedIn: ref(false)
};

globalState.loggedIn.value = sessionStorage.getItem('token') ? true : false;

app.config.globalProperties.$globalState = globalState;

app.config.globalProperties.setLoggedIn = () => {
  const value = sessionStorage.getItem('token') ? true : false;

  globalState.loggedIn.value = value;
};

app.use(router)
   .use(VueSweetalert2)
   .mount("#app");
