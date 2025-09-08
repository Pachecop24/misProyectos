// Importaciones diferentes formas

import * as helpers from './modulos/helpers.js';
import multiplicar, { PI, restar, sumar } from './modulos/math.js';
import Usuario from './modulos/usuarios.js';

// Usando los módulos importados
console.log(sumar(5, 3));
console.log(restar(10, 4));
console.log(multiplicar(2, 6));
console.log(PI);

// Usando la clase
const usuario = new Usuario('Kevin', 'Correo@hola.kevin.com.mx');
console.log(usuario.saludar());

// Usando helpers
console.log(helpers.formatearFecha(new Date()));
console.log(helpers.generarId());

// También se puede importar con alias
import { formatearFecha as formato } from './modulos/helpers.js';
console.log(formato(new Date()));

