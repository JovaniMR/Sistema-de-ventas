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
              <router-link class="btn btn-primary" to="/usuarios">
                <span class="fas fa-arrow-left"></span> Regresar
              </router-link>
            </div>
            <div class="card-body">
              <!-- Card formulario busqueda -->
              <div class="card">
                <form action>
                  <h5 class="card-header bg-info">Editar información</h5>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Primer Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.firstname"
                        />
                      </div>
                      <div class="col-5">
                        <label for>Segundo Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.secondname"
                        />
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Apellidos</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.lastname"
                        />
                      </div>
                      <div class="col-5">
                        <label for>Usuario</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.username"
                        />
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Correo</label>
                        <input
                          type="email"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.email"
                        />
                      </div>
                      <div class="col-5">
                        <label for>Contraseña</label>
                        <input
                          type="password"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="user.password"
                        />
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Fotografía</label>
                        <input type="file" class="form-control" @change="guardarFile" />
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row justify-content-center">
                      <div class="col-4">
                        <button
                          class="btn btn-sm btn-primary"
                          @click.prevent="guardarUsuario"
                        >Modificar información</button>
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
              id: this.$attrs.id,  
              firstname:'',
              secondname:'',
              lastname:'',
              username:'',
              email:'',
              password:'',
              photo:''
            },
        }
    },
    mounted(){
       this.getUserById();
    },
    methods:{
        getUserById(){
           axios.get('/usuarios/obtener',{
               params:{
                 'id': this.user.id
               }
           }).then(response => {
              this.user.firstname = response.data.firstname;
              this.user.secondname = response.data.secondname;
              this.user.lastname = response.data.lastname;
              this.user.username = response.data.username;
              this.user.email = response.data.email;
              
           });
        },
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

        axios.put(`/usuarios/${this.user.id}`,{
            'firstname' : this.user.firstname,
            'secondname': this.user.secondname,
            'lastname'  : this.user.lastname,
            'username'  : this.user.username,
            'email'     : this.user.email,
            'password'  : this.user.password,
            'idFile'    : idFile
        }).then(response =>{
            Swal.fire({
              icon: 'success',
              title: 'Datos actualizados correctamente',
              showConfirmButton: false,
              timer: 1500
            })
        });

        //this.limpiarCampos();
        this.$router.push('/usuarios');
      }
    }
    
}
</script>