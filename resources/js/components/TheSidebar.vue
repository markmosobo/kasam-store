<template>
    <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <router-link to="/dashboard" custom v-slot="{ href, navigate, isActive }">
                  <a
                    :href="href"
                    :class="{ active: isActive }"
                    class="nav-link"
                    @click="navigate"
                  >
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
        </router-link>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-menu-button-wide"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
          <li>
            <router-link to="/allproducts" custom v-slot="{ href, navigate, isActive }">
                  <a
                    :href="href"
                    :class="{ active: isActive }"
                    class="nav-link"
                    @click="navigate"
                  >
              <i class="bi bi-circle"></i><span>All Products</span>
            </a>
            </router-link>
          </li>
          <li v-show="user.role == 'admin'">
            <router-link to="/restocked" custom v-slot="{ href, navigate, isActive }">
                  <a
                    :href="href"
                    :class="{ active: isActive }"
                    class="nav-link"
                    @click="navigate"
                  >
              <i class="bi bi-circle"></i><span>Restocked</span>
            </a>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/categories" custom v-slot="{ href, navigate, isActive }">
                      <a
                        :href="href"
                        :class="{ active: isActive }"
                        class="nav-link"
                        @click="navigate"
                      >
              <i class="bi bi-circle"></i>
              <span>Categories</span>
            </a>
            </router-link>
          </li><!-- End Dashboard Nav -->

          <li class="nav-item">
            <router-link to="/suppliers" custom v-slot="{ href, navigate, isActive }">
                      <a
                        :href="href"
                        :class="{ active: isActive }"
                        class="nav-link"
                        @click="navigate"
                      >
              <i class="bi bi-circle"></i>
              <span>Suppliers</span>
            </a>
            </router-link>
          </li><!-- End Dashboard Nav -->

        </ul>
      </li>

      <li class="nav-item">
        <router-link to="/purchases" custom v-slot="{ href, navigate, isActive }">
                  <a
                    :href="href"
                    :class="{ active: isActive }"
                    class="nav-link"
                    @click="navigate"
                  >
          <i class="bi bi-cart"></i>
          <span>Sales</span>
        </a>
        </router-link>
      </li><!-- End Dashboard Nav -->

      <li v-show="user.role == 'admin'" class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Manage Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <router-link to="/users" custom v-slot="{ href, navigate, isActive }">
                <a
                  :href="href"
                  :class="{ active: isActive }"
                  class="nav-link"
                  @click="navigate"
                >
              <i class="bi bi-circle"></i><span>All Users</span>
              </a>
            </router-link>
          </li> 
          <li>
            <router-link to="/resetpassword" custom v-slot="{ href, navigate, isActive }">
                <a
                  :href="href"
                  :class="{ active: isActive }"
                  class="nav-link"
                  @click="navigate"
                >
              <i class="bi bi-circle"></i><span>Reset Password</span>
              </a>
            </router-link>
          </li>                     
        </ul>
      </li> 
      <!-- End Dashboard Nav -->

      <li v-show="user.role == 'admin' || user.role == 'storekeeper'" class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Manage KRA</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <router-link to="/aboutinfo" custom v-slot="{ href, navigate, isActive }">
                <a
                  :href="href"
                  :class="{ active: isActive }"
                  class="nav-link"
                  @click="navigate"
                >
              <i class="bi bi-circle"></i><span>About Shop</span>
              </a>
            </router-link>
          </li> 
          <li>
            <router-link to="/taxtot" custom v-slot="{ href, navigate, isActive }">
                <a
                  :href="href"
                  :class="{ active: isActive }"
                  class="nav-link"
                  @click="navigate"
                >
              <i class="bi bi-circle"></i><span>TOT Rate</span>
              </a>
            </router-link>
          </li>                     
        </ul>
      </li> 
      <!-- End Components Nav -->



    </ul>

  </aside><!-- End Sidebar-->
</template>

<script>
export default {
  name: 'TheSidebar',
  data(){
    return {
      user: []
    }
  },
  mounted(){
    this.user = JSON.parse(localStorage.getItem('user'));

  }
  
}
</script>

<style scoped>

</style>
