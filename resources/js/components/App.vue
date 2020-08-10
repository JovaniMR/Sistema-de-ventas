<template>
    <div>

    <!-- Navbar -->
      <navbar-component :ruta="ruta"></navbar-component> 
    <!-- /.navbar -->

  <!-- Main Sidebar Container -->
      <sidebar-component :ruta="ruta"></sidebar-component>
  <!-- /.Main Sidebar Container  -->

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <transition
        enter-active-class="animated slideInRight"
        leave-active-class="animated slideOutRight">
           
          <router-view style="animation-duration: 0.80s"></router-view>
        </transition>
      </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
        <footer-component></footer-component>
  <!-- /.Footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
    </div>
</template>

<script>

import Navbar from './plantilla/Navbar.vue';
import Sidebar from './plantilla/Sidebar.vue';
import Footer from './plantilla/Footer.vue';

export default {
    name: 'App',
    props:['ruta'],
    components: {
      Navbar,
      Sidebar,
      Footer
    }
}
</script>