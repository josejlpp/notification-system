<template>
  <div class="container">
    <Navbar></Navbar>
    <component :is="currentView" />
  </div>
</template>

<script>
import NotificationList from "./components/NotificationList.vue";
import NotificationSentList from "./components/NotificationSentList.vue";
import Navbar from "./components/Navbar.vue";

const routes = {
  '/': NotificationList,
  '/list-notification': NotificationList,
  '/list-notification-sent': NotificationSentList,
}

export default {
  components: {
    NotificationList,
    NotificationSentList,
    Navbar
  },
  data() {
    return {
      currentPath: window.location.hash
    }
  },
  computed: {
    currentView() {
      return routes[this.currentPath.slice(1) || '/'] || NotFound
    }
  },
  mounted() {
    window.addEventListener('hashchange', () => {
      this.currentPath = window.location.hash
    })
  }
}
</script>

<style>
  @import 'bootstrap/dist/css/bootstrap.min.css';
  @import "bootstrap-vue/dist/bootstrap-vue.min.css";
</style>