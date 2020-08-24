<template>
  <div>
    <div class="container-fluid">
      <div class="row mb-2 mt-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Usuarios</h1>
        </div>
      </div>
    </div>

    <div class="row ml-5">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img
                class="profile-user-img img-fluid img-circle"
                :src=" user.path"
                alt="User profile picture"/>
            </div>

            <h3 class="profile-username text-center">{{ name }}</h3>

            <hr>

            <p class="text-muted text-center">Vendedor</p>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong>
              <i class="fas fa-book mr-1"></i> Nombre Completo
            </strong>

            <p class="text-muted">{{ fullName }}</p>

            <hr />

            <strong>
              <i class="fas fa-envelope-square mr-1"></i> Correo
            </strong>

            <p class="text-muted">{{ user.email }}</p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-8">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" href="#settings" data-toggle="tab">Información Personal</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Primer Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Primer Nombre" v-model="user.firstname"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="Name" class="col-sm-2 col-form-label">Segundo Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Name" placeholder="Segundo Nombre" v-model="user.secondname"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" v-model="user.lastname"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="usuario" placeholder="Usuario" v-model="user.username"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Correo" v-model="user.email"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputName2" placeholder="Contraseña" v-model="user.password"/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Fotografía</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" @change="guardarFile" />
                    </div>
                  </div>
                  <div class="form-group row ">
                    <div class="offset-sm-2 col-sm-10 text-center">
                      <button class="btn btn-primary btn-sm btn-block" @click.prevent="guardarUsuario">Modificar información</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
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
              photo:'',
              path:''
            },
        }
    },
    mounted(){
       this.getUserById();
    },
    computed:{
        fullName(){
           return this.user.firstname + ' ' + this.user.secondname + ' ' + this.user.lastname;
        },
        name(){
           return this.user.firstname + ' ' + this.user.secondname;
        }
    },
    methods:{
        cargaFoto(){
          axios.get('/usuarios/busca',{
              params:{
                  nombre: this.user.firstname
              }
          }).then(response =>{
             this.user.path = response.data[0].path;
             console.log('path: '+this.user.path);
          });
        },
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

              this.cargaFoto();
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

            this.getUserById();
        });

        // this.$router.push('/usuarios');
      }
    }
};
</script>