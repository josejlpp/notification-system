<template>
  <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/list-notification">Notification List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#/list-notification-sent">Log sent notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="http://localhost:8025/">Mailbox</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar"
}
</script>

<style lang="css" scoped>
  .navbar {
    margin-bottom: 60px;
  }
</style>