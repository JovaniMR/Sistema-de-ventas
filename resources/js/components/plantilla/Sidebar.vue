<template>
    <div>
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img :src="ruta + '/img/AdminLTELogo.png'"
           alt="Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Gestión de ventas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img :src="ruta+'/img/avatar.png'" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Jovani Martinez</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link class="active nav-link" to="/">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          
          </li>
          <li class="nav-header">OPERACIONES</li>
          <li class="nav-item">
          <router-link class="nav-link" to="/pedidos">
               <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Pedidos
              </p>
          </router-link>
          </li>
          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/clientes">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Clientes
              </p>
            </router-link>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="·" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">CONFIGURACIÓN</li>
          <li class="nav-item">
            <router-link class="nav-link" to="#">
             <i class="nav-icon fas fa-sitemap"></i>
              <p>Categorias</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/productos">
              <i class="nav-icon fas fa-apple-alt"></i>
              <p>Producto</p>
            </router-link>
          </li>
          <li class="nav-header">ADMINISTRACIÓN</li>
          <li class="nav-item">
            <router-link class="nav-link" to="/usuarios">
              <i class="fas fa-users"></i>
              <p>Usuarios</p>
            </router-link>
          </li>
           <li class="nav-item">
            <router-link class="nav-link" to="/roles">
               <i class="fas fa-unlock-alt"></i>
              <p>Roles</p>
            </router-link>
          </li>
           <li class="nav-item">
            <router-link class="nav-link" to="/permisos">
               <i class="fas fa-key"></i>
              <p>Permisos</p>
            </router-link>
          </li>
          <li class="nav-header">REPORTES</li>
          <li class="nav-item">
            <router-link class="nav-link" to="/pedidos">
               <i class="nav-icon fas fa-file-export"></i>
              <p class="text">Pedidos</p>
            </router-link>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    </div>
</template>

<script>
export default {
    props: ['ruta']
}
</script>