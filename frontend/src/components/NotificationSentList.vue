<template>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        Notification Sent List
      </a>
    </div>
  </nav>
  <table class="table table-hover">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Notification Id</th>
      <th scope="col">Category</th>
      <th scope="col">Channel</th>
      <th scope="col">Status</th>
      <th scope="col">Created at</th>
    </tr>
    </thead>
    <tbody>
    <tr v-if="!items">
      <td colspan="7" style="text-align: center">Empty or loading...</td>
    </tr>
    <tr v-for="item in itemsComputed" v-if="items">
      <th scope="row">{{ item.id}}</th>
      <td>{{ item.user }}</td>
      <td>#{{ item.notification_id }}</td>
      <td>#{{ item.category_id }} {{ item.category }}</td>
      <td>{{ item.channel }}</td>
      <td>{{ item.status }}</td>
      <td>{{ formatDate(item.created_at) }}</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import _ from 'lodash';
export default {
  name: "NotificationSentList",
  data() {
    return {
      items: null
    }
  },
  methods: {
    getList() {
      this.axios.get("http://localhost:8080/api/notification/sent").then((response) => {
        this.items = response.data
      })
    },
    formatDate(val) {
      let date = new Date(val)
      let dateFormatted = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear()
      let hourFormatted = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds()
      return dateFormatted + " " + hourFormatted
    }
  },
  computed: {
    itemsComputed() {
      return _.orderBy(this.items, ['id'], ['desc'])
    }
  },
  created() {
    this.getList()
  },
}
</script>

<style scoped>

</style>