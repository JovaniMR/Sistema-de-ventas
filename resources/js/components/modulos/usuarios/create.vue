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
                        <router-link class=" btn btn-primary" to="/usuarios" >
                            <span class="fas fa-plus-square"></span> Regresar</router-link>
                  </div>
                  <div class="card-body">
                      <!-- Card formulario busqueda -->
                        <div class="card">
                          <form action="">
                             <h5 class="card-header bg-info">Información personal</h5>
                            <div class="card-body">
                              
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Primer Nombre</label>
                                      <input type="text" class=" form-control" style="height:30px" required v-model="user.firstname">
                                    </div>
                                    <div class="col-5">
                                      <label for="">Segundo Nombre</label>
                                      <input type="text" class=" form-control" style="height:30px" required v-model="user.secondname">
                                    </div>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Apellidos</label>
                                      <input type="text" class=" form-control" style="height:30px" required v-model="user.lastname">
                                    </div>
                                    <div class="col-5">
                                      <label for="">Usuario</label>
                                      <input type="text" class=" form-control" style="height:30px" required v-model="user.username" >
                                    </div>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Correo</label>
                                      <input type="email" class=" form-control" style="height:30px" required v-model="user.email">
                                    </div>
                                    <div class="col-5">
                                      <label for="">Contraseña</label>
                                      <input type="password" class=" form-control" style="height:30px" required v-model="user.password">
                                    </div>
                                  </div>
                                  <div class="row justify-content-center">
                                    <div class="col-5">
                                      <label for="">Fotografía</label>
                                      <input type="file" class=" form-control"  @change="guardarFile">
                                    </div>
                                  </div>
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                          <button class="btn btn-sm btn-primary" @click.prevent="guardarUsuario">Guardar información</button>
                                          <button class="btn btn-sm btn-warning" @click.prevent="limpiarCampos">Limpiar</button>
                                    </div>
                                </div>
                            </div>
                          </form>  
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
            user:{
              firstname:'',
              secondname:'',
              lastname:'',
              username:'',
              email:'',
              password:'',
              photo:''
            },
            idFile:''
      }
  },
  methods:{
      guardarFile(e){

        let file = e.target.files[0];
        
        let formData = new FormData();
       
        formData.append('photo',file);

        axios.post('/files',formData).then(response =>{
          this.user.photo = response.data;
          this.buscaFoto();

        }); 
      },
      buscaFoto(){

         axios.get('/files/busca',{
            params:{
                photo: this.user.photo
            }
         }).then(response => {
             var idFile =  response.data[0].id;
             this.guardarUsuario(idFile);
         });           
      },
      guardarUsuario(idFile){

        axios.post('/usuarios',{
            'firstname' : this.user.firstname,
            'secondname': this.user.secondname,
            'lastname'  : this.user.lastname,
            'username'  : this.user.username,
            'email'     : this.user.email,
            'password'  : this.user.password,
            'idFile'    : idFile
        });

        //this.limpiarCampos();
        this.$router.push('/usuarios');
      },
      limpiarCampos(){
        this.user.firstname='',
        this.user.secondname='',
        this.user.lastname='',
        this.user.username='',
        this.user.email='',
        this.user.password='' 
      }

  }
}
</script>