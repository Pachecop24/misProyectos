// Exportación por defecto de una clase
export default class Usuario {
    constructor(nombre, email) {
        this.nombre = nombre;
        this.email = email;
    }

    saludar() {
        return `Hola, soy ${this.nombre}`;
    }
}