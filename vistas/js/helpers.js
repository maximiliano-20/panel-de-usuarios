export const urlPagina = 'http://localhost/panel-de-usuarios/';



export function mostrarMensajes(mensaje,tipoError) {
    const alerta = document.querySelector('.alerta');
    if(!alerta){
      const divMensaje = document.createElement('div');
      divMensaje.classList.add('alerta','alert','text-center','mt-1');
      if (tipoError === 'error') {
        divMensaje.classList.add('alert-danger');
      }else if(tipoError === 'warning'){
        divMensaje.classList.add('alert-warning','text-white');
      }else{
        divMensaje.classList.add('alert-success');
      }
      
      divMensaje.textContent = mensaje;
      formulario.appendChild(divMensaje);

      setTimeout(()=>{
            divMensaje.remove();
      },3000)

    }
}

