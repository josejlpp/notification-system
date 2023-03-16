<template>
  <table class="table table-hover">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category</th>
      <th scope="col">Message</th>
      <th scope="col">Created at</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in itemsComputed">
      <th scope="row">{{ item.id}}</th>
      <td>{{ item.category_id }}</td>
      <td>{{ item.message }}</td>
      <td>{{ formatDate(item.created_at) }}</td>
    </tr>
    </tbody>
  </table>
</template>

<script>
import _ from "lodash";

export default {
  name: "NotificationList",
  data() {
    return {
      items: []
    }
  },
  methods: {
    getList() {
      this.axios.get("http://localhost:8080/api/notification").then((response) => {
        this.items = response.data
        console.log(response.data)
      })
    },
    formatDate(val) {
      console.log(val);
      let date = new Date(val)
      return (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear()
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