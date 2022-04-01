import { urlPagina } from './helpers.js';

$(document).ready(function () {

    const formularioRol = document.querySelector('#formularioRol');
    const formularioEditarRol = document.querySelector('#formularioEditarRol');
    const rol = document.querySelector('#rol');
    const rolEditar = document.querySelector('#editarRol');
    const rolTabla = document.querySelector('#roles');

    
    
    Eventos();
    function Eventos () {
       formularioRol.addEventListener('submit',agregarRol);
       formularioEditarRol.addEventListener("submit",modificarRol);
       rolTabla.addEventListener('click',editarRol);
       rolTabla.addEventListener('click',confirmarRol);
    }
    
    
    async function agregarRol(e) {
      e.preventDefault();
    
      try {
      const datos = new FormData(formularioRol);
      const url = `${urlPagina}vistas/ajax/roles/agregarRol.php`;
      const respuesta = await fetch(url,{
        method : 'POST',
        body : datos
      });
      const resultado = await respuesta.json();
      console.log(resultado);
      const {error,ok,validar} =  resultado;

      if(error === false){
        Swal.fire({
            icon : 'error',
            title : 'Campo Vacio',
            text : 'Debe Rellenar el campo'
          });
      }else if(validar === true){
        Swal.fire({
            icon : 'error',
            title : 'No se permiten numeros',
            text : 'Debe introducir caracteres'
          });
      }else{
        Swal.fire({
            icon : 'success',
            title : 'Rol Agregado Correctamente',
            text : 'El rol pudo ser registrado'
          });
          formularioRol.reset();
          $('#modal-agregar-rol').modal('toggle');
          tabla_roles.ajax.reload(null, false);
      }
      
        
      } catch (error) {
        console.log(error)
      }
      
    }
    

    
    
    async function editarRol(e) {
      if (e.target.classList.contains("EditarRol")) {
         const id = parseInt(e.target.dataset.rol);
         const datos = new FormData();
         datos.append("id",id);
         
         const url = `${urlPagina}vistas/ajax/roles/editarRol.php`;
         const respuesta = await fetch(url,{
           method : 'POST',
           body : datos
         });
         const resultado = await respuesta.json();
         resultado.forEach(roles =>{
           const {id ,rol } = roles;
           document.querySelector('#id').value = id;
           document.querySelector('#editarRol').value = rol;
         });
      }
    
    }
    
    async function modificarRol(e) {
      e.preventDefault();
      try {
        const datos = new FormData(formularioEditarRol);
        const url = `${urlPagina}vistas/ajax/roles/modificarRol.php`;
        const respuesta = await fetch(url,{
          method : 'POST',
          body : datos
        });
        const resultado = await respuesta.json();
        const {error,ok,validar} =  resultado;

        if(error === false){
          Swal.fire({
              icon : 'error',
              title : 'Campo Vacio',
              text : 'Debe Rellenar el campo'
            });
        }else if(validar === true){
          Swal.fire({
              icon : 'error',
              title : 'No se permiten numeros',
              text : 'Debe introducir caracteres'
            });
        }else{
          Swal.fire({
              icon : 'success',
              title : 'Rol Modificado Correctamente',
              text : 'El rol pudo ser modificado'
            });
            formularioRol.reset();
            $('#modal-editar-rol').modal('toggle');
            tabla_roles.ajax.reload(null, false);
        }
          
        } catch (error) {
          console.log(error)
        }
      
    }
    
    
    
    function confirmarRol(e) {
       
      if(e.target.classList.contains('EliminarRol')){
    
         Swal.fire({
                title : 'Estas Seguro de eliminar el rol',
                text : 'No podras revertir los cambios',
                icon : 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si Eliminar!'
    
            }).then((result) => {
              if (result.isConfirmed) {
                 const IdRol = parseInt(e.target.dataset.rol);
                 console.log(IdRol);
                 eliminarRol(IdRol);
                 Swal.fire(
                'Eliminado!',
                'El rol se elimino correctamente',
                'success'
    
              )
    
            }
        });
      }
    }
    
    
    async function eliminarRol (id) {
      try {
        const url = `${urlPagina}vistas/ajax/roles/eliminarRol.php`;
        const datos = new FormData();
        datos.append("id",id);
        const respuesta = await fetch(url,{
           method : 'POST',
           body : datos
        });
        const resultado = await respuesta.json();
        tabla_roles.ajax.reload(null, false);
      } catch (error) {
        console.log(error);
      }
    }
    
    
    let tabla_roles = $("#tablaRol").DataTable({
    
            "responsive": true,
            "autoWidth": false,
            "ajax": {
             "url": `${urlPagina}vistas/ajax/roles/selectRol.php`,
             "dataSrc": ""
           },
           "columns": [
        
           {"data" : "id"},
           {"data" : "rol"},
           
    
    
           {
             
             
             "data" : "id",
             "render" : function(data,type,row){
                 return  `<div class='text-center aver'><div class='btn-group'><button  data-rol = "${data}" class='btn btn-primary EditarRol' data-toggle='modal' data-target='#modal-editar-rol'>Editar</button><button  data-rol = "${data}" class='btn btn-danger EliminarRol' data-toggle='modal' data-target='#modalEliminarUsuario'>Eliminar</button></div></div>`;
    
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
    
          //  "order": [[ 5, "desc" ]]
    
    
    });
    
    
    
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    })