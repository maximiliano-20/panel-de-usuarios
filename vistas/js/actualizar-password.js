import {urlPagina,mostrarMensajes } from './helpers.js';
const formulario = document.querySelector("#formulario");
const emailInput = document.querySelector("#email");
const passwordInput = document.querySelector("#password");



formulario.addEventListener('submit',actualizarPassword);
document.addEventListener('DOMContentLoaded',()=>{
    mostrarTokens();
});

async function actualizarPassword(e) {
    e.preventDefault();
    const url = `${urlPagina}vistas/ajax/usuarios/actualizarPassword.php`;
    const datos = new FormData(formulario);
    const respuesta = await fetch(url,{
        method : 'POST',
        body : datos
    });
    const resultado = await respuesta.json();
    console.log(resultado);
    const { error,validar } = resultado;
    if(error === true){
       mostrarMensajes("Debes ingresar una contraseña",'error');
    }else if(validar === true){
       mostrarMensajes("La contraseña debe contener 6 caracteres",'error');
    }else{
        mostrarMensajes("La contraseña ha sido actualizada");
        setTimeout(() => {
               mostrarMensajes("Redirigiendo......");
               window.location.href =`${urlPagina}usuario/login`;
        },3000);
    }
}

function mostrarTokens(){ 
    const parametros = new URLSearchParams(window.location.search);
    const email = parametros.get('email');
    document.querySelector('#email').value = email;
}

