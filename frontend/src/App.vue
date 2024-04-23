<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
      <!-- Navbar brand -->
      <a class="navbar-brand" href="/" style="color: #141f38; font-size: 25px; "><span style="color: #023071; "
          class="nav-brand-two">CP</span>Bank</a>
      <!-- Search bar -->
      <div class="relative flex items-center">
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
          <i class="fas fa-search text-gray-400"></i>
        </span>
      </div>

      <!-- Collapsible navbar content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link ml-5 navigation" to="/register">Register</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link ml-5 navigation" to="/login">Login</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <router-view>
    
  </router-view>
  
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
