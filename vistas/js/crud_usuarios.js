import { urlPagina } from './helpers.js';

$(document).ready(function() {


    const formulario = document.querySelector('#formulario');
    const formularioEditar = document.querySelector('#formularioEditar')
    const formularioRegistro = document.querySelector('#formularioRegistro');
    const usuarioInput = document.querySelector('#usuario_nombre');
    const emailInput = document.querySelector('#usuario_email');
    const passwordInput = document.querySelector('#usuario_password');
    const imagenInput = document.querySelector('#usuario_imagen');
    const editarImagen = document.querySelector('#editarImagen');
    const estadoInput = document.querySelector('#usuario_estado');
    const rolInput = document.querySelector('#rol');
    const bodyUsuarios = document.querySelector('#usuarios');
    let editando;
    
    
    
    eventos();
    function eventos () {
      imagenInput.addEventListener('change', previewImagen);
      editarImagen.addEventListener('change', previewEditImagen);
      formulario.addEventListener('submit', agregarUsuario);
      formularioEditar.addEventListener('submit',actualizarUsuario);
      bodyUsuarios.addEventListener('click',editarUsuario);
      bodyUsuarios.addEventListener('click',confirmarUsuario);
      emailInput.addEventListener('change',emailExiste);
    
      
    
    }
    
    
    async function emailExiste() {
      const datos = new FormData(formulario);
      const url = `${urlPagina}vistas/ajax/usuarios/validarEmail.php`;
      const respuesta = await fetch(url,{
          method : 'POST',
          body : datos
      });
      const resultado = await respuesta.json();
      if(resultado === true){
        Swal.fire({
          icon : 'error',
          title : 'Email Ocupado',
          text : 'El email ya existe intenta con otro email'
        });
        
      }
    
    }
      
    
    async function agregarUsuario (e) {
      e.preventDefault();

      try {
    
      const datos = new FormData(formulario);
      const url = `${urlPagina}vistas/ajax/usuarios/insertarUsuario.php`;
    
      const respuesta = await fetch(url,{
        method : 'POST',
        body : datos
      });
    
      const resultado = await respuesta.json();
      const { vacios,errorEmail,ok} = resultado;
      if(vacios === true){
        Swal.fire({
          icon : 'error',
          title : 'Campos Vacios',
          text : 'Debe rellenar todos los campos'
        });
        return;
      }
        
      if(errorEmail === true){
        Swal.fire({
          icon : 'error',
          title : 'Email Invalido',
          text : 'Debe verificar que sea un email valido'
        });
        return 
       }
       
       if(ok === true){
          Swal.fire({
          icon : 'success',
          title : 'Usuario Insertado',
          text : 'El Usuario ha sido insertado correctamente'
        });
        formulario.reset();
        $('#modal-agregar-usuario').modal('toggle');
        tabla_admin.ajax.reload(null, false);
        tabla_usuarios.ajax.reload(null, false);
           
       }else{
          Swal.fire({
          icon : 'error',
          title : 'Usuario no Insertado',
          text : 'El Usuario no se pudo insertar'
         });  
       }
    
      } catch(e) {
        console.log(e);
      }
    
      
    }
    
    
    
    function previewImagen (e) {
      const nuevaImagen = document.querySelector('#nuevaFoto');

      const datosImagen = e.target.files[0];
      const { type } = datosImagen;
    
      if ( type !=  "image/png"  && type !=  "image/jpg" && type !=  "image/jpeg") {
        
        Swal.fire({
              icon : 'error',
              title : 'Formato no compatible',
              text : 'La imagen debe ser .png , .jpg ,.jpeg'
            });
    
      }
    
      let lector = new FileReader();
      lector.readAsDataURL(imagenInput.files[0]);
      
      
      lector.onload = () =>{
        nuevaImagen.setAttribute('src', lector.result);
        nuevaImagen.style.width = '100px';    
      }
              

    }
    
      
    function previewEditImagen (e) {
      const fotoEditada = document.querySelector('#fotoEditada');

      const datosImagen = e.target.files[0];
      const { type } = datosImagen;
    
      if ( type !=  "image/png"  && type !=  "image/jpg" && type !=  "image/jpeg") {
        
        Swal.fire({
              icon : 'error',
              title : 'Formato no compatible',
              text : 'La imagen debe ser .png , .jpg ,.jpeg'
            });
    
      }
    
      let lector = new FileReader();
      lector.readAsDataURL(editarImagen.files[0]);
      
      
      lector.onload = () =>{
        fotoEditada.setAttribute('src', lector.result);
        nuevaImagen.style.width = '100px';    
      }
              

    }
    
    
    
      
    
    let tabla_usuarios = $("#usuario").DataTable({
    
                 "responsive": true,
                 "autoWidth": false,
                 "ajax": {
                  "url": `${urlPagina}vistas/ajax/usuarios/mostrarUsuario.php`,
                  "dataSrc": ""
                },
                "columns": [
                { "data": "usuario_nombre" },
                { "data": "usuario_email" },
                
    
                {
                  "data" : "usuario_estado",
                  "render" : function(data,type,row){
    
                      if (data === "ACTIVO") {
                        return `<span class='badge badge-success p-2'>${data}</span>`;
                      }else { 
                        return `<span class='badge badge-danger p-2'>${data}</span>`;
    
                      }
                  }
    
                },
    
                {"data" : "rol"},
                
    
                {
        
                 'data': 'usuario_imagen',
                 'sortable': false,
                 'searchable': false,
                 'render': function (data, type, JsonResultRow, meta) {
    
                  return `<img  style="width: 50px;height: 70px" class="img-fluid" src="${urlPagina}imagenes/${JsonResultRow.usuario_imagen}">`;
                }
    
                },
              
    
                {
                  
                  
                  "data" : "id",
                  "render" : function(data,type,row){
                      return  `<div style="display: block;" class='text-center'><div class='btn-group'><button  data-usuario = "${data}" class='btn btn-primary EditarUsuario' data-toggle='modal' data-target='#modal-editar-usuario'>Editar</button></div></div>`;
                   
                    }
    
                 
    
                  
                }
    
                ],
                "language": {
    
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ registros",
                  "sZeroRecords":    "No se encontraron resultados",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla",
                  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                  "sInfoPostFix":    "",
                  "sSearch":         "Buscar:",
                  "sUrl":            "",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                  },
                  "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
    
                },
    
                "order": [[ 4, "desc" ]]
    
       
         });
    
    let tabla_admin = $("#admin").DataTable({
    
                 "responsive": true,
                 "autoWidth": false,
                 "ajax": {
                  "url": `${urlPagina}vistas/ajax/usuarios/mostrarUsuario.php`,
                  "dataSrc": ""
                },
                "columns": [
                { "data": "usuario_nombre" },
                { "data": "usuario_email" },
                
    
                {
                  "data" : "usuario_estado",
                  "render" : function(data,type,row){
    
                      if (data === "ACTIVO") {
                        return `<span class='badge badge-success p-2'>${data}</span>`;
                      }else {
                        return `<span class='badge badge-danger p-2'>${data}</span>`;
    
                      }
                  }
    
                },
    
                {"data" : "rol"},
                
    
                {
        
                 'data': 'usuario_imagen',
                 'sortable': false,
                 'searchable': false,
                 'render': function (data, type, JsonResultRow, meta) {
    
                  return `<img  style="width: 50px;height: 70px" class="img-fluid" src="${urlPagina}imagenes/${JsonResultRow.usuario_imagen}">`;
                }
    
                },
              
    
                {
                  
                  
                  "data" : "id",
                  "render" : function(data,type,row){
                      return  `<div style="display: block;" class='text-center'><div class='btn-group'><button  data-usuario = "${data}" class='btn btn-primary EditarUsuario' data-toggle='modal' data-target='#modal-editar-usuario'>Editar</button><button  data-usuario = "${data}" class='btn btn-danger EliminarUsuario' data-toggle='modal' data-target='#modalEliminarUsuario'>Eliminar</button></div></div>`;
                   
                    }
    
                 
    
                  
                }
    
                ],
                "language": {
    
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ registros",
                  "sZeroRecords":    "No se encontraron resultados",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla",
                  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                  "sInfoPostFix":    "",
                  "sSearch":         "Buscar:",
                  "sUrl":            "",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                  },
                  "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
    
                },
    
                "order": [[ 4, "desc" ]]
    
       
         });
    
    
    
    
    
    
    async function editarUsuario (e) {
       
       if (e.target.classList.contains('EditarUsuario')) {
           const id = parseInt ( e.target.dataset.usuario );
           const datos = new FormData();
           datos.append('id',id);
    
           try {
             const url = `${urlPagina}vistas/ajax/usuarios/editarUsuario.php`;
             const respuesta = await fetch(url,{
                  method : 'POST',
                  body : datos
             });
    
             const resultado = await respuesta.json();     
                     
             datosUsuario(resultado);   
    
           } catch(e) {
             console.log(e);
           }
       }
    }
    
    
    
    
    
    function datosUsuario (resultado) {
    
      resultado.forEach(usuario => {
    
        const { id,usuario_nombre, usuario_email ,usuario_estado,
        usuario_password,usuario_imagen ,rol_id ,rol} = usuario
    
        document.querySelector('#id').value = id ;
        document.querySelector('#editarNombre').value = usuario_nombre ;
        document.querySelector('#editarEmail').value = usuario_email ;
        document.querySelector('#usuario_password').value = usuario_password ;
        document.querySelector('.input').style.display = 'none' ;
        document.querySelector('#editarEstado').value = usuario_estado ;
        document.querySelector('#fotoEditada').src = `${urlPagina}/imagenes/${usuario_imagen}`;
        document.querySelector('#editarRol').value = parseInt(rol_id);
        editando = true;
       
    
         
            
    });
    }
    
    
    
    
    function confirmarUsuario(e) {
       
      if(e.target.classList.contains('EliminarUsuario')){
         
         Swal.fire({
                title : 'Estas Seguro de eliminar el usuario',
                text : 'No podras revertir los cambios',
                icon : 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si Eliminar!'
    
            }).then((result) => {
              if (result.isConfirmed) {
                 const idUsuario = parseInt(e.target.dataset.usuario);
                 console.log(idUsuario);
                 eliminarUsuario(idUsuario);
                 Swal.fire(
                'Eliminado!',
                'El contacto se elimino correctamente',
                'success'
    
              )
    
            }
        });
      }
    }
    
    async function actualizarUsuario(e) {
      e.preventDefault();
       
      try {
        const datos = new FormData(formularioEditar);
        const url = `${urlPagina}vistas/ajax/usuarios/modificarUsuario.php`;
        const respuesta = await fetch(url,{
          method : 'POST',
          body : datos
        });
    
        const resultado = await respuesta.json();
        console.log(resultado);
        const { vacios ,errorEmail,ok} = resultado;

      if(vacios === true){
        Swal.fire({
          icon : 'error',
          title : 'Campos Vacios',
          text : 'Debe rellenar todos los campos'
        });
      }else if(errorEmail === true){
        Swal.fire({
          icon : 'error',
          title : 'Email Invalido',
          text : 'Debe verificar que sea un email valido'
        });
      }else{
        Swal.fire({
          icon : 'success',
          title : 'Usuario Modificado',
          text : 'El Usuario ha sido modificado correctamente'
        });
       
        $('#modal-editar-usuario').modal('toggle');
        tabla_usuarios.ajax.reload(null, false);
        tabla_admin.ajax.reload(null, false);
      }
       
      } catch (error) {
        console.log(error);
      }
    }
    
    
    
    async function eliminarUsuario(id) {
    
      try {
        const url = `${urlPagina}vistas/ajax/usuarios/eliminarUsuario.php`;
        const datos = new FormData();
        datos.append('id',id);
      
        const respuesta = await fetch(url,{
           method : 'POST',
           body : datos
        });
        const resultado = await respuesta.json();
        tabla_admin.ajax.reload(null, false);
        tabla_usuarios.ajax.reload(null, false);
        
    
        
      } catch (error) {
        console.log(error);
      }
    }
    
    
    

    
    
    });