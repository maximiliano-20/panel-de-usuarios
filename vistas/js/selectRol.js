
document.addEventListener('DOMContentLoaded', mostrarRol); 
const rol = document.querySelector('#rol');
const editarRol = document.querySelector('#editarRol');
const urlPagina = 'http://localhost/panel-de-usuarios/';


async function mostrarRol () {
    try {
    	const url = `${urlPagina}vistas/ajax/roles/selectRol.php`;
    	const respuesta = await fetch(url);
    	const resultado = await respuesta.json();
    	let contenido = ''; 

        
    	contenido = `<option>Seleccione un Rol</option>`;
    	
    	resultado.forEach(roles => {
    		const { id , rol } = roles;    	     
             contenido+= `   
                 <option value='${id}'>${rol}</option>
             `;
    	});
      
    	rol.innerHTML = contenido;
		editarRol.innerHTML = contenido;
		

    } catch(e) {
    	console.log(e);   
    }
}
