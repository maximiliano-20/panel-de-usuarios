import {urlPagina,mostrarMensajes } from './helpers.js';
const formulario = document.querySelector('#formulario');


formulario.addEventListener('submit',recuperarPassword);

async function recuperarPassword (e) {
e.preventDefault();

try { 
   const datos = new FormData(formulario);
   const url = `${urlPagina}vistas/ajax/usuarios/recuperarPassword.php`;
   const respuesta = await fetch(url,{
       method : 'POST',
       body : datos
   });
   const resultado = await respuesta.json();
   const {error,existe} = resultado;
   validarCampo(error);
   if(existe === true){
       mostrarMensajes('Se ha enviado el email de restablecimiento');
   }else{
      mostrarMensajes('El email no existe en la base de datos','error');
   }

   console.log(resultado);
 
} catch (error) {
   console.log(error);
}

}

function validarCampo(campos){
   if(campos === true){
      mostrarMensajes('Debes rellenar todos los campos','error');
   }
}



