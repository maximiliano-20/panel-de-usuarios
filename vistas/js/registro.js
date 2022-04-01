import {urlPagina,mostrarMensajes } from './helpers.js';
const formularioRegistro = document.querySelector('#formulario');
const emailInput = document.querySelector('#usuario_email');



formularioRegistro.addEventListener('submit',registrarUsuario);
emailInput.addEventListener('change',emailExiste);
 
 
async function registrarUsuario(e) {
    e.preventDefault();
    try {
        const datos = new FormData(formularioRegistro);
        const url = `${urlPagina}vistas/ajax/usuarios/registrarUsuario.php`;
        const respuesta = await fetch(url,{
            method : 'POST',
            body : datos
        });
        const resultado = await respuesta.json();
        const { validarCampos,errorEmail,validarPassword,ok} = resultado;
        console.log(resultado);
        validarVacios(validarCampos);
        validarPasswords(validarPassword);
        validarEmails(errorEmail);
        if(ok === true){
            mostrarMensajes('El usuario ha sido registrado');
              setTimeout(()=>{
                window.location.href = `${urlPagina}usuario/login`;
              },3000);
             
        }else{
            mostrarMensajes('No se pudo registrar el usaurio','error');
        }
          
    } catch (error) {
        console.log(error);
    }
}


async function emailExiste() {
    const datos = new FormData(formularioRegistro);
    const url = `${urlPagina}vistas/ajax/usuarios/validarEmail.php`;
    const respuesta = await fetch(url,{
        method : 'POST',
        body : datos
    });
    const resultado = await respuesta.json();
    if(resultado === true){
        mostrarMensajes('El email ya existe intenta con otro email','warning');
    }
  
  }


function validarVacios(campos) {
    if (campos === true) {
        mostrarMensajes('Debe rellenar todos los campos','error');

    }
}

function validarEmails(email) {
    if (email === true) {
        mostrarMensajes('Debe ingresar un email valido','warning');
    }
}

function validarPasswords(password) {
    if (password === true) {
        mostrarMensajes('La contraseña debe contener 6 o mas caracteres','error');
    }
}

