<template>    
    <div class="shadow-container">
        <div class="card-body">       
            <div class="card-header">                    
                <h4 class="card-text">Usuarios</h4>
            </div>     
        </div>   
        <template v-if="vista=='listado'">    
            <div class="p-5 bg-white rounded">        
                <div class="ml-5 mb-5">                    
                    <input type="button" value="Nuevo Usuario" v-on:click="cambiarVista('registro')" class="btn btn-primary btn-nuevo">                
                </div>                         
                <div class="float-right mb-0 input-search">
                    <span>Buscar : </span>
                    <input type="text" id="mySearchText" class="border" @keyup="buscar()">                
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered my-5" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th width="5%">ID</th>
                                <th width="10%">Sede</th>
                                <th width="15%">Nombre</th>
                                <th width="15%">Usuario</th>
                                <th width="30%">Correo Electrónico</th>
                                <th width="15%">Estatus</th>
                                <th class="text-center" width="10%">Acción</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            <tr  class="text-center" v-for="usuario in usuarios">
                                <td>{{ usuario.id }}</td>
                                <td>{{ usuario.sede }}</td>
                                <td>{{ usuario.name }}</td>
                                <td>{{ usuario.username }}</td>
                                <td>{{ usuario.email }}</td>                                
                                <td v-if="usuario.status == 1" class="activo">                                    
                                    Activo                                        
                                </td>
                                <td v-if="usuario.status == 0" class="inactivo">
                                    Inactivo
                                </td>
                                <td class="text-center">
                                    <i class='bx bxs-edit bx-sm mr-4 text-success btn-editar' title="Editar" @click="editarRegistro(usuario)"></i>
                                    <i class='bx bxs-trash bx-sm text-danger btn-eliminar' title="Eliminar" @click="eliminarRegistro(usuario)"></i>
                                </td>
                            </tr>                            
                        </tbody>                  
                    </table>
                </div>
            </div>                   
        </template>
        <!-- formulario de Nuevo Usuario-->
        <template v-else-if="vista=='registro'">
            <div class="p-3 bg-white rounded">  
                <div class="col-md-12 mb-0 text-center bg-light">
                    <h4>{{ titulo }}</h4>
                </div>
                <div class="card-body mt-5">
                    <form class="needs-validation" novalidate>      

                        <div class="form-row">
                            <div class="col-md-2"></div>
                                                         
                                <label class="col-md-2 col-form-label-lg">
                                    Sede
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="sede" value="sede" required>
                                       <option value="" selected="selected">Seleccione Sede</option>
                                       <option value="Samat">Samat</option>                                       
                                    </select>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione una Sede!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-building bx-sm' ></i>
                                    </div>                                    
                                </div>                                    
                            </div>
                        </div>                 
                            
                        <div class="form-row">
                            <div class="col-md-2"></div>

                                <label for="name" class="col-md-2 col-form-label-lg">
                                    Nombre completo
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="name" v-model="name" class="form-control" placeholder="Nombre completo" required >
                                    <div class="form-control-position">
                                        <i class='bx bx-user bx-sm'></i>
                                    </div>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div> 
                                    <div class="invalid-feedback">
                                      ¡Introduzca nombre completo!
                                    </div>                                                                
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>                                
                            
                                <label for="email" class="col-md-2 col-form-label-lg">
                                    Correo Electrónico
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="email" name="email" v-model="email" class="form-control" placeholder="Correo Electrónico" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Formato incorrecto!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-envelope bx-sm'></i>
                                    </div>                                                                       
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>

                                <label for="username" class="col-md-2 col-form-label-lg">
                                    Usuario
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="text" name="username" v-model="username" class="form-control" placeholder="Usuario" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca nombre de usuario!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-log-in bx-sm'></i>
                                    </div>                                   
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>                               
                                                               
                                <label for="password" class="col-md-2 col-form-label-lg">
                                    Password
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <input type="password" name="password" v-model="password" class="form-control" placeholder="Password" required>
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Introduzca password!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bxs-lock bx-sm' ></i>
                                    </div>
                                </div>                                                              
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>
                                                         
                                <label class="col-md-2 col-form-label-lg">
                                    Rol
                                </label>                                

                            <div class="col-md-4 form-group">
                                <div class="position-relative has-icon-left">
                                    <select class="form-control" v-model="rol" value="rol" @change="asignaRol( $event )" required>
                                       <option value="" selected="selected">Seleccione Rol</option>
                                       <option v-for="rol in roles" :key="rol.id" :value="rol.id" v-text="rol.rol"></option>
                                    </select>                                    
                                    <div class="valid-feedback">
                                      <i>¡Correcto!</i>
                                    </div>
                                    <div class="invalid-feedback">
                                      ¡Seleccione un Rol!
                                    </div>
                                    <div class="form-control-position">
                                        <i class='bx bx-id-card bx-sm' ></i>
                                    </div>                                    
                                </div>                                    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-2"></div>
                                                         
                                <label class="col-md-2 col-form-label-lg">
                                    Estatus de usuario
                                </label>                                

                            <div class="col-md-4 form-group text-center">
                                <label class="switch">
                                  <input type="checkbox" v-model="status">
                                  <span class="slider round"></span>
                                </label>                        
                            </div>
                        </div>                       

                        <div class="form-row mt-5">
                            <div class="col-md-2"></div>
                            
                            <div class="col-md-3 d-flex justify-content-center" v-if="boton == 'registro'" >                                    
                                <button type="button" @click="validarFormulario('registro')" name="registro" class="btn btn-primary btn-registrar">
                                    <span class="align-middle ml-25">Registrar</span>
                                </button>
                            </div>

                            <div class="col-md-3 d-flex justify-content-center" v-if="boton == 'edicion'" >                                    
                                <button type="button" @click="validarFormulario('edicion')" name="registro" class="btn btn-primary btn-registrar">
                                    <span class="align-middle ml-25">Actualizar</span>
                                </button>
                            </div>

                            <div class="col-md-3 d-flex justify-content-center">
                                <i class='bx bx-cancel bx-sm' ></i>
                                <input type="button" name="cancelar" @click="cancelarRegistro()" class="btn btn-danger btn-cancelar" value="Cancelar">
                            </div>
                        </div>
                                               
                    </form>                    
                </div>
            </div>
        </template>        
    </div>
</template>

<style scoped>
    /* Se importan los estilos del modulo */
    @import "../../../public/css/usuario.css";
    @import "../../../public/css/switch.css";
</style>    

<script type="text/javascript">

    import datatable from 'datatables';    

    export default {
        data() {
            return {
                //Vista de listado de usuarios
                vista: 'listado',
                usuarios: [],
                titulo: 'Agregar Nuevo Usuario',
                tipos_comercio: [],
                boton: 'registro',
                roles: [],
                tabla: '',

                //Vista de registro de usuarios
                id: 0,
                name: '',
                username: '',
                email: '',
                password: '',  
                rol: '',
                status: 0,
                sede: '',
            }            
        },

        //Aqui se inyectan los componentes importados
        components: {
            datatable            
        },

        methods: {
            cambiarVista( opcion ) {                
                this.vista = opcion;

                if(this.vista == "registro") {
                    this.listarRoles();
                } else {
                    this.listarUsuarios();
                }
            },

///////////////////////////* Listado de Usuarios *//////////////////////////////////////////            

            listarUsuarios(){
                let me = this;

                var url = '/user';

                axios.get(url).then(function (response) {
                // handle success                      
                var respuesta = response.data;                                    
                me.usuarios = respuesta.users.data;
                me.tablaUsuarios();
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
              .finally(function () {
                // always executed
              });
            },

            tablaUsuarios() {
                $(function() {
                    this.tabla = $('#dataTable').DataTable(
                    {   
                        retrieve: true, 
                        searching: true,
                        ordering:  true,
                        select: true,
                        paging: true,

                        "language": 
                            {                        
                                 "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                            },               
                        "dom": '<"top"li>rt<"bottom"p><"clear">'
                    }); 
                });
            },            

            buscar() {
                $(function() {                    
                    $('#dataTable').dataTable().fnFilter($('#mySearchText').val());
                });
            }, 

////////////////////////* Registro de usuarios *////////////////////////////////////////

            asignaRol(e)
            {
                this.rol = e.target.value;
            },

            listarRoles() {
                let me = this;

                var url = '/rol';

                axios.get(url).then(function (response) {
                    // handle success                    
                    var respuesta = response.data;                    
                    me.roles = respuesta.data;                  
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });
            },
            
            validarFormulario( accion ) {
                let me=this;
            //alert(this.formulario);
             var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    //form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                          event.preventDefault();
                          event.stopPropagation();                           
                        } else {
                            if( accion == 'registro' ) { 
                                console.log(accion);
                                me.agregarRegistro(); 
                            } else { 
                                me.actualizarRegistro(); 
                            }
                        }
                        form.classList.add('was-validated');
                    //}, false);
                });
            },

            agregarRegistro() {

                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                
                axios.post('/user/registrar', {                        
                        //'imagen': me.imagen
                        'name': me.name,
                        'username': me.username,
                        'email': me.email,
                        'sede': me.sede,
                        'password':me.password,
                        'status':me.status,
                        'rol': me.rol
                    }).then(function (response) {                        
                        alerta.fire(
                            'Registro!',
                            'Registro exitoso.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.cambiarVista( "listado" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            editarRegistro( data ) {

                this.listarRoles();

                let me=this; 
                me.id = data.id;               
                var url = '/user?id='+me.id;

                 axios.get(url).then(function (response) {
                    // handle success                            
                    var respuesta = response.data;                     
                    var usuario = respuesta.users;                    
                    var rol = respuesta.rol;                                 
                    me.name = usuario.name;
                    me.email = usuario.email;
                    me.username = usuario.username;
                    me.sede = usuario.sede,
                    me.status = usuario.status;
                    me.rol = rol.id;
                    me.titulo = 'Editar Usuario';
                    me.boton = "edicion";
                  })
                  .catch(function (error) {
                    // handle error
                    console.log(error);
                  })
                  .finally(function () {
                    // always executed
                  });

                this.vista = "registro";                   
                 
            },

            actualizarRegistro() {                
                
                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })                

                let me=this;
                
                axios.put('/user/actualizar', {
                        'id': me.id,                      
                        'name': me.name,
                        'username': me.username,
                        'email': me.email,
                        'sede': me.sede,
                        'password':me.password,
                        'status':me.status,
                        'rol': me.rol
                    }).then(function (response) {                        
                        alerta.fire(
                            'Actualizado!',
                            'Registro actualizado.',
                            'success'
                        );
                        me.limpiarCampos();
                        me.cambiarVista( "listado" );                        

                    }).catch(function (error) {
                    // handle error
                    console.log(error);
                    });
            },

            eliminarRegistro( data ) {
                const alerta = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                  },
                 buttonsStyling: false,
                })

                alerta.fire({
                  title: '¿Estás seguro de eliminar el Objetivo?',
                  text: '',                  
                  showCancelButton: true,
                  confirmButtonText: '<i class="fa fa-check fa-2x"></i>Aceptar',
                  cancelButtonText: '<i class="fa fa-times fa-2x"></i>Cancelar',                 
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    let me=this;
                        axios.delete('/user/eliminar/'+data.id).then(function (response) {  
                                //console.log( response );                                
                                alerta.fire(
                                    'Eliminado!',
                                    'Registro eliminado.',
                                    'success'
                                );
                                me.usuarios = [];
                                
                                me.cambiarVista("listado");                                
                            }).catch(function (error) {
                            // handle error
                            console.log(error);
                            });                    
                  } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                  ) {                    
                  }
                })
            },

            cancelarRegistro() {
                this.limpiarCampos();
                this.cambiarVista("listado");
            },

            limpiarCampos() {
                this.roles = [];
                this.usuarios = [];
                this.id = 0;
                this.name = '';
                this.email= '';
                this.username = '';
                this.password = '';
                this.sede = '';
                this.status = 0;
                this.rol = '';
                this.boton = 'registro';
                this.titulo = 'Agregar Nuevo Usuario';
            },
        },

        mounted() {
            this.listarUsuarios();
            console.log('Component mounted.')
        }
    }
</script>
