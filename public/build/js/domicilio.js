function iniciarDomicilio(){obtenerDomicilio()}function mostrarDomicilio(n){const{calle:i,colonia:o,interior:e,exterior:a,telefono:c}=n;document.querySelector("#direcciones").innerHTML=`\n        <a href="/editar-direccion">\n            <h3>Precione para editar</h3>\n            <p>colonia: <span>${o}</span></p>\n            <p>calle: <span>${i}</span></p>\n            <p>Telefono: <span>${c}</span></p>\n            <p>interior: <span>${e}</span></p>\n            <p>Exterior: <span>${a}</span></p>\n         </a>\n    `}async function obtenerDomicilio(){try{const n="http://localhost:3000/api/direccion",i=await fetch(n);mostrarDomicilio(await i.json())}catch(n){console.log(n)}}document.addEventListener("DOMContentLoaded",(function(){iniciarDomicilio()}));