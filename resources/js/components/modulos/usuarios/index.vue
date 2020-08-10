<template>
    <div>
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Usuarios</h1>
                </div> 
            </div>
        </div>


<!--Card general  -->

    <div class="content container-fluid">
        <div class="row">
           <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                        <router-link class=" btn btn-primary" to="" >
                            <span class="fas fa-plus-square"></span> Nuevo usuario</router-link>
                  </div>
                  <div class="card-body">
                      <!-- Card formulario busqueda -->
                        <div class="card">
                          <form action="">
                             <h5 class="card-header bg-info">Criterios de búsqueda</h5>
                            <div class="card-body">
                              
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Nombre</label>
                                      <input type="text" class=" form-control" style="height:30px" v-model="fillBusqueda.Nombre">
                                    </div>
                                    <div class="col-5">
                                      <label for="">Usuario</label>
                                      <input type="text" class=" form-control" style="height:30px"  v-model="fillBusqueda.Usuario">
                                    </div>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Correo Electrónico</label>
                                      <input type="text" class=" form-control" style="height:30px" v-model="fillBusqueda.Correo">
                                    </div>
                                    <div class="col-5">
                                      <label for="">Estado</label><br>
                                      <el-select class="select" v-model="fillBusqueda.Estado" placeholder="Seleccione el estado" >
                                         <el-option 
                                           v-for="item in listEstados"
                                           :key="item.value"
                                           :label="item.label"
                                           :value="item.value">
                                         </el-option>
                                      </el-select>
                                    </div>
                                  </div>
                                
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                          <button class="btn btn-sm btn-primary" @click.prevent="BuscaUsuario">Buscar</button>
                                          <button class="btn btn-sm btn-warning" @click.prevent="limpiarCriteriosBsq">Limpiar</button>
                                    </div>
                                </div>
                            </div>
                          </form>  
                        </div>
                        <!-- Card resultados busqueda -->
                        <div class="card">
                             <h5 class="card-header bg-info">Resultados</h5>
                            <div class="card-body">
                                <table class="table">
                                   <thead>
                                      <tr>
                                        <!-- <th scope="col">Fotografía</th> -->
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                      </tr>
                                    </thead>
                                    <paginate name="listUsuarios" :list="listUsuarios" :per="5" tag="tbody">
                                      <tr v-for="user in paginated('listUsuarios')" :key="user.id">
                                        <!-- <th scope="row">{{ user.id }}</th> -->
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.username }}</td>
                                        <td>
                                          
                                        <span v-if="user.state == 'A'" class="badge badge-success">Activo</span>
                                        <span v-else class="badge badge-danger">Inactivo</span>
                                        </td>
                                        <td>
                                            <router-link class="btn btn-info btn-sm " to="">
                                                <span class="fas fa-folder"></span> Ver
                                            </router-link>
                                            <router-link class="btn btn-primary btn-sm " to="">
                                                <span class="fas fa-pencil-alt"></span> Editar
                                            </router-link>
                                            <router-link class="btn btn-warning btn-sm " to="">
                                                <span class="fas fa-key"></span> Permisos
                                            </router-link>
                                            <router-link class="btn btn-danger btn-sm " to="">
                                                <span class="fas fa-trash"></span> Desactivar
                                            </router-link>
                                            <router-link class="btn btn-success btn-sm " to="">
                                                <span class="fas fa-check"></span> Activar
                                            </router-link>
                                        </td>
                                      </tr>
                                    </paginate>
                                </table>
                            </div>
                            <div class="card-footer ">
                                <div class="row text-align-right">
                                    <div class="col ">
                                        <paginate-links 
                                        for="listUsuarios" 
                                        :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'}">
                                        </paginate-links>
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
      fillBusqueda: {
        Nombre:'',
        Usuario:'',
        Correo:'',
        Estado:'' 
      },
      listUsuarios: [],
      listEstados: [
        {value: 'A', label: 'Activo'},
        {value: 'I', label: 'Inactivo'}
      ],
      paginate: ['listUsuarios']
    }
   },
    methods: {
        limpiarCriteriosBsq(){
          this.fillBusqueda.Nombre='',
          this.fillBusqueda.Usuario='',
          this.fillBusqueda.Correo='',
          this.fillBusqueda.Estado=''
        },
        BuscaUsuario(){
          var url ='/usuario/busca';
          axios.get(url,{
            params:{
              nombre :  this.fillBusqueda.Nombre,
              usuario:  this.fillBusqueda.Usuario,
              correo:   this.fillBusqueda.Correo,
              estado:   this.fillBusqueda.Estado
            }
          }).then(response=>{
            this.listUsuarios = response.data;
          });

          this.limpiarCriteriosBsq();
        }
    }
}
</script>