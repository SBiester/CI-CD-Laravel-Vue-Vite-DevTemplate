<template>
    <div class="sidebar">
      <ul>
        <li v-for="item in menuItems" :key="item.name">
          <router-link
            v-if="item.name !== 'Login'"
            :to="item.path"
            class="menu-item"
            active-class="active"
          >
            <i :class="item.icon"></i>&nbsp; {{ item.name }}
          </router-link>
          <a v-else @click="redirectToAzure" class="menu-item">
            <i :class="item.icon"></i>&nbsp; {{ item.name }}
          </a>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: "Sidebar",
    setup() {
      const redirectToAzure = () => {
        window.location.href = "/login/azure"; 
      };
  
      const menuItems = [
        { name: "Dashboard", path: "/dashboard", icon: "fas fa-tachometer-alt" },
        { name: "Submit Idea", path: "/", icon: "fas fa-paper-plane" },
        { name: "Ideen", path: "/ideen", icon: "fas fa-lightbulb" },
        { name: "Login", path: "/login/azure", icon: "fas fa-sign-in-alt" }, 
      ];
  
      return { menuItems, redirectToAzure };
    },
  };
  </script>

<style scoped>

.sidebar {
    width: 250px;
    height: 100vh ;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
}
ul {
    list-style: none;
    padding: 0;
}
.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}
</style>
