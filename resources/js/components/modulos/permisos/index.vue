<template>
  <div>
    <div class="container-fluid">
      <div class="row mb-2 mt-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Permisos</h1>
        </div>
      </div>
    </div>

    <!--Card general  -->

    <div class="content container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <!-- Button trigger modal -->
              <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#guardar"
              >
                <span class="fas fa-plus-square"></span> Nuevo permiso
              </button>
            </div>
            <div class="card-body">
              <!-- Card formulario busqueda -->
              <div class="card">
                <form action>
                  <h5 class="card-header bg-info">Criterios de búsqueda</h5>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          v-model="fillBusqueda.nombre"
                        />
                      </div>
                      <div class="col-5">
                        <label for>Url</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          v-model="fillBusqueda.slug"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row justify-content-center">
                      <div class="col-2">
                        <button class="btn btn-sm btn-primary" @click.prevent="buscaPermiso">Buscar</button>
                        <button
                          class="btn btn-sm btn-warning"
                          @click.prevent="limpiarCriteriosBsq"
                        >Limpiar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- Card resultados busqueda -->
              <div class="card">
                <h5 class="card-header bg-info">Resultados</h5>
                <div class="card-body">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <!-- <th scope="col">Fotografía</th> -->
                        <th scope="col">Nombre</th>
                        <th scope="col">URL</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <paginate name="listPermisos" :list="listPermisos" :per="5" tag="tbody">
                      <tr v-for="permission in paginated('listPermisos')" :key="permission.id">
                        <td>{{ permission.name }}</td>
                        <td>{{ permission.slug }}</td>
                        <td>
                          <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            @click="AbrirModal(permission.id)"
                          >
                            <span class="fas fa-pencil-alt"></span> Editar
                          </button>
                        </td>
                      </tr>
                    </paginate>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="row text-align-right">
                    <div class="col">
                      <paginate-links
                        for="listPermisos"
                        :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}"
                      ></paginate-links>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Información del modal -->

    <!-- Modal Guardar Permiso -->
    <div
      class="modal fade"
      id="guardar"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h5 class="card-header bg-info">Registrar Permiso</h5>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="row justify-content-center">
                    <div class="col">
                      <label for>Nombre</label>
                      <input
                        type="text"
                        class="form-control"
                        style="height:30px"
                        v-model="permiso.nombre"
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
                        v-model="permiso.slug"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-sm btn-primary"
              data-dismiss="modal"
              @click.prevent="GuardarPermiso"
            >Guardar Permiso</button>
            <button class="btn btn-sm btn-warning" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Editar Permiso -->
    <div
      class="modal fade"
      id="Editar"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h5 class="card-header bg-info">Editar Permiso</h5>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <div class="row justify-content-center">
                    <div class="col">
                      <label for>Nombre</label>
                      <input
                        type="text"
                        class="form-control"
                        style="height:30px"
                        v-model="permiso.nombre"
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
                        v-model="permiso.slug"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-sm btn-primary"
              data-dismiss="modal"
              @click.prevent="editarPermiso"
            >Modificar Permiso</button>
            <button class="btn btn-sm btn-warning" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
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
      permiso: {
        nombre: "",
        slug: "",
        id: "",
      },
      fillBusqueda: {
        nombre: "",
        slug: "",
      },
      listPermisos: [],
      paginate: ["listPermisos"],
    };
  },
  methods: {
    limpiarCriteriosBsq() {
      (this.fillBusqueda.nombre = ""), (this.fillBusqueda.slug = "");
      (this.permiso.nombre = ""), (this.permiso.slug = "");
    },
    buscaPermiso() {
      var url = "/permisos/busca";
      axios
        .get(url, {
          params: {
            nombre: this.fillBusqueda.nombre,
            slug: this.fillBusqueda.slug,
          },
        })
        .then((response) => {
          this.listPermisos = response.data;
        });

      this.limpiarCriteriosBsq();
    },
    GuardarPermiso() {
      axios
        .post("/permisos", {
          name: this.permiso.nombre,
          slug: this.permiso.slug,
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Permiso registrado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
        });
    },
    AbrirModal(id) {
      this.permiso.id = id;
      $("#Editar").modal("show");

      this.buscaPermisoById();
    },
    buscaPermisoById() {
      axios
        .get("/permisos/buscaId", {
          params: {
            id: this.permiso.id,
          },
        })
        .then((response) => {
          this.permiso.nombre = response.data[0].name;
          this.permiso.slug = response.data[0].slug;
        });
    },
    editarPermiso() {
      axios
        .put(`/permisos/${this.permiso.id}`, {
          'name': this.permiso.nombre,
          'slug': this.permiso.slug,
        })
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Permiso actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          this.buscaPermiso();
        });
    },
  },
};
</script>
