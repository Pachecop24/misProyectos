// Exportación de múltiples funciones
export function formatearFecha(fecha) {
    return fecha.toLocaleDateString();
}

export function generarId() {
    return Math.random().toString(36).substring(2);
}

// Exportación con alias
export { formatearFecha as formatoFecha };
