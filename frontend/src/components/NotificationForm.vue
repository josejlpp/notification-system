<template>
  <div class="row justify-content-md-center">
    <div class="col-8 bg-body-secondary" id="not-form">
      <form @submit="submitForm" method="post">
        <div class="mb-3">
          <label class="form-label">Category</label>
          <select v-model="category_id" name="category_id" class="form-select" required placeholder="Please select one">
            <option selected value="" v-if="categories">Please select one</option>
            <option selected value="" v-if="!categories">Loading categories</option>
            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" v-model="message" required></textarea>
        </div>
        <button class="btn btn-primary">Submit</button> <span>{{ responseForm }}</span>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotificationForm",
  data() {
    return {
      category_id: null,
      message: null,
      categories: null,
      responseForm: null,
      feedbackCategory: null
    }
  },
  methods: {
    getCategories() {
      this.axios.get('http://localhost:8080/api/categories').then((response) => {
        this.categories = response.data
      })
    },
    submitForm(event) {
      event.preventDefault()
      this.responseForm = null
      this.validator()

      this.axios.post('http://localhost:8080/api/notification', {
          category_id: this.category_id,
          message: this.message
        }).then((response) => {
            this.responseForm = response.data
            this.category_id = null
            this.message = null
        }).catch(function (error) {
          this.responseForm = "Request error!"
          console.log(error)
          alert(error)
      });
    },
    validator() {
      if (!this.category_id || !this.message) {
        console.log('empty field');
        return false;
      }
    }
  },
  created() {
    this.getCategories()
  }
}
</script>

<style scoped>
  textarea {
    height: 100px;
  }

  #not-form {
    border-radius: 5px;
    padding: 15px;
  }
</style>