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
              <!-- Card formulario busqueda -->
              <div class="card">
                <form action>
                  <h5 class="card-header bg-info">Editar rol</h5>
                  <div class="card-body">
                    <div class="row justify-content-center">
                      <div class="col-5">
                        <label for>Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          style="height:30px"
                          required
                          v-model="rol.nombre"
                        />
                      </div>
                      <div class="col-5">
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
                      <div class="col-2">
                        <button
                          class="btn btn-sm btn-primary"
                          @click.prevent="guardarRol"
                        >Modificar el rol</button>
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
            rol:{
              id: this.$attrs.id,  
              nombre:'',
              slug:''
            },
        }
    },
    mounted(){
       this.getRolById();
    },
    methods:{
        getRolById(){
           axios.get('/roles/obtener',{
               params:{
                 'id': this.rol.id
               }
           }).then(response => {
            
               this.rol.nombre = response.data[0].name;
               this.rol.slug = response.data[0].slug;
           });
        },
      guardarRol(){

        axios.put(`/roles/${this.rol.id}`,{
            'name' : this.rol.nombre,
            'slug': this.rol.slug,

        }).then(response =>{
            Swal.fire({
              icon: 'success',
              title: 'Rol actualizado correctamente',
              showConfirmButton: false,
              timer: 1500
            })
        });

        this.$router.push('/roles');
      }
    }
    
}
</script>