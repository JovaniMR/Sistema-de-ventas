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
              <router-link class="btn btn-primary" to="/roles/crear">
                <span class="fas fa-plus-square"></span> Nuevo Rol
              </router-link>
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
                        <button class="btn btn-sm btn-primary" @click.prevent="buscaRol">Buscar</button>
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
                    <paginate name="listRoles" :list="listRoles" :per="5" tag="tbody">
                      <tr v-for="rol in paginated('listRoles')" :key="rol.id">
                        <td>{{ rol.name }}</td>
                        <td>{{ rol.slug }}</td>
                        <td>
                          <!-- Button trigger modal -->
                          <button
                            type="button"
                            class="btn btn-info btn-sm"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            @click="verRol(rol.id,rol.name,rol.slug)"
                          ><span class="fas fa-folder"></span>
                            Ver
                          </button>

                          <router-link
                            class="btn btn-primary btn-sm"
                            :to="{name:'roles.editar', params:{id: rol.id}}"
                          >
                            <span class="fas fa-pencil-alt"></span> Editar
                          </router-link>
                        </td>
                      </tr>
                    </paginate>
                  </table>
                </div>
                <div class="card-footer">
                  <div class="row text-align-right">
                    <div class="col">
                      <paginate-links
                        for="listRoles"
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <!-- Card formulario busqueda -->
              <div class="col">
                <div class="card">
                  <form action>
                    <h5 class="card-header bg-info">Información del rol</h5>
                    <div class="card-body">
                      <div class="row justify-content-center">
                        <div class="col">
                          <label for>Nombre</label>
                          <input type="text" class="form-control" disabled style="height:30px"  v-model="rol.name"/>
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col">
                          <label for>Url</label>
                          <input type="text" class="form-control" disabled style="height:30px"  v-model="rol.slug"/>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <!-- Card lista permisos -->
                <div class="card">
                  <h5 class="card-header bg-info">Permisos</h5>
                  <div class="card-body">
                    <div style="max-height: 200px !important; overflow: auto !important">
                      <table class="table" >
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">URL amigable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="permission in listPermissionsByRol" :key="permission.id">
                            <td >{{ permission.name }}</td>
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
      rol:{
        name:'',
        slug:''
      },
      fillBusqueda: {
        nombre: "",
        slug: "",
      },
      listRoles: [],
      paginate: ["listRoles"],
      listPermissionsByRol:[]
    };
  },
  methods: {
    limpiarCriteriosBsq() {
      (this.fillBusqueda.nombre = ""), (this.fillBusqueda.slug = "");
    },
    buscaRol() {
      var url = "/roles/busca";
      axios
        .get(url, {
          params: {
            nombre: this.fillBusqueda.nombre,
            slug: this.fillBusqueda.slug,
          },
        })
        .then((response) => {
          this.listRoles = response.data;
        });

      this.limpiarCriteriosBsq();
    },

    //metodos del Modal (Ver)

    verRol(idRol,rolName,rolSlug){

      this.rol.name = rolName; 
      this.rol.slug = rolSlug; 

      axios.get('/roles/getRolAndPermissions', {
        params: {
          'id': idRol
        }
        }).then(response => {
          this.listPermissionsByRol = response.data;
        });
    }
  },
};
</script>
