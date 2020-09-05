<template>
  <div>
    <div class="container-fluid">
      <div class="row mb-2 mt-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rol</h1>
        </div>
      </div>
    </div>
    <!--Card general  -->

    <div class="content container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <router-link class="btn btn-primary" to="/roles">
                <span class="fas fa-arrow-left"></span> Regresar
              </router-link>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Card formulario busqueda -->
                <div class="col-md-5">
                  <div class="card">
                    <form action>
                      <h5 class="card-header bg-info">Información del rol</h5>
                      <div class="card-body">
                        <div class="row justify-content-center">
                          <div class="col">
                            <label for>Nombre</label>
                            <input
                              type="text"
                              class="form-control"
                              style="height:30px"
                              required
                              v-model="rol.name"
                            />
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col">
                            <label for>Url</label>
                            <input
                              type="text"
                              class="form-control"
                              style="height:30px"
                              required
                              v-model="rol.slug"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row justify-content-center">
                          <div class="col-7">
                            <button
                              class="btn btn-sm btn-primary"
                              @click.prevent="guardarRol"
                            >Guardar rol</button>
                            <button
                              class="btn btn-sm btn-warning"
                              @click.prevent="limpiarCampos"
                            >Limpiar</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-7">
                  <!-- Card lista permisos -->
                  <div class="card">
                    <h5 class="card-header bg-info">Permisos</h5>
                    <div class="card-body">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">URL amigable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="permission in selectedPermissions"
                            :key="permission.id"
                            @click.prevent="marcarFila(permission.id-1)"
                          >
                            <th scope="row ">
                              <el-checkbox type="checkbox" v-model="permission.checked"></el-checkbox>
                            </th>
                            <td>{{ permission.name }}</td>
                            <td>{{ permission.slug }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      rol: {
        name: "",
        slug: "",
      },
      listPermissions: [],
      selectedPermissions: [],
    };
  },
  mounted() {
    this.getListarPermisosByRol();
  },
  methods: {
    guardarRol() {
      axios.post("/roles", {
        name: this.rol.name,
        slug: this.rol.slug,
        listPermissions: this.selectedPermissions
      }).then(response =>{
         Swal.fire({
              icon: 'success',
              title: 'Rol registrado correctamente',
              showConfirmButton: false,
              timer: 1500
            })
      });

      this.$router.push("/roles");
    },
    getListarPermisosByRol() {
      axios.get("/roles/permisos").then((response) => {
        this.listPermissions = response.data;
        this.seleccionarPermisos();
      });
    },
    seleccionarPermisos() {
      let me = this;
      me.listPermissions.map(function (obj, position) {
        me.selectedPermissions.push({
          id: obj.id,
          name: obj.name,
          slug: obj.slug,
          checked: false,
        });
      });
    },
    marcarFila(id) {
      this.selectedPermissions[id].checked = !this.selectedPermissions[id]
        .checked;
    },
    limpiarCampos() {
      (this.rol.name = ""), (this.rol.slug = "");
    },
  },
};
</script>