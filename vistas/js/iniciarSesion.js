import {urlPagina,mostrarMensajes } from './helpers.js';
const formulario = document.querySelector('#formulario');

// Eventos
formulario.addEventListener('submit', iniciarSesion);


async function iniciarSesion (e) {
	e.preventDefault(); 

	const usuarioInput = document.querySelector('#usuario').value.trim();
	const passwordInput = document.querySelector('#password').value.trim();

	if (usuarioInput === '' || passwordInput === '') {
		mostrarMensajes('Debes rellenar todos los campos','error');
	} 
    
    const datos = new FormData(formulario);
    const url = `${urlPagina}vistas/ajax/usuarios/login.php`;
	const respuesta = await fetch(url,{
		method : 'POST',
		body : datos
	  });

	const resultado = await respuesta.json();
	console.log(resultado);

	usuarioActivo(resultado.activo)
	if (!resultado.ok === true) {
		mostrarMensajes('Usuario y Contraseña Incorrectas','error');
	 }else{
		mostrarMensajes('Bienvenido redirigiendo al panel');
	    setTimeout(() => {
	   	window.location=`${urlPagina}usuario/${resultado.rol}`;
	    },2000);
	 }

    

	  

}

function usuarioActivo(activo){
	if(!activo === true){
		mostrarMensajes('El usuario esta inactivo contacte con el administrador','warning');
	}

}