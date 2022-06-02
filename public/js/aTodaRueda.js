var carretera = document.querySelector('.carretera');
var contenedorCoches = document.querySelector('.coches');
var direccion = {
    arriba: false,
    abajo: false,
    izquierda: false,
    derecha: false
}
var puntuacion;
var pantallaJugar = document.querySelector('.pantallaJugar');
var pantallaFin = document.querySelector('.pantallaFin');
var intervaloJuego;
var enemigos;
var jugador;

document.addEventListener('keydown', pulsar);
document.addEventListener('keyup', soltar);


//Se modifican los atributos del array direccion al presionar la tecla de movimiento
function pulsar(e) {
    e.preventDefault();
    if (e.key == 'w') {
        direccion.arriba = true;
    }
    if (e.key == 'a') {
        direccion.izquierda = true;
    }
    if (e.key == 'd') {
        direccion.derecha = true;
    }
    if (e.key == 's') {
        direccion.abajo = true;
    }
    console.log(e.key);

}

//Se modifica el array direccion al soltar la tecla
function soltar(e) {
    e.preventDefault();
    if (e.key == 'w') {
        direccion.arriba = false;
    }
    if (e.key == 'a') {
        direccion.izquierda = false;
    }
    if (e.key == 'd') {
        direccion.derecha = false;
    }
    if (e.key == 's') {
        direccion.abajo = false;
    }
    console.log(e.key);

}

//Se comprueba el array direccion para mover el jugador, si la tecla correspondiente está pulsada, este se moverá
function moverJugador() {

    if (direccion.arriba && jugador.y>-1100) {
        jugador.y -= 3
        jugador.style.top = jugador.y + 'px';
    }
    if (direccion.abajo && jugador.y<-600) {
        jugador.y += 3
        jugador.style.top = jugador.y + 'px';
    }
    if (direccion.izquierda && jugador.x>50) {
        jugador.x -= 3
        jugador.style.left = jugador.x + 'px';
    }
    if (direccion.derecha && jugador.x<500) {
        jugador.x += 3
        jugador.style.left = jugador.x + 'px';
    }
}

//funcion para comenzar el juego
function start(coche) {
    pantallaJugar.setAttribute('class', 'oculto');
    crearJugador(coche);
    crearlineas();
    crearEnemigos(coche);

    enemigos = document.querySelectorAll('.enemigo');
    puntuacion = 0;


    intervaloJuego = setInterval(() => {
        jugar(jugador)
    }, 10);
}

//funcion para crear y posicionar el coche del jugador
function crearJugador(coche) {
    jugador = document.createElement('div');
    jugador.setAttribute('class', 'jugador coche' + coche);
    carretera.appendChild(jugador);
    jugador.style.top = '-800px';
    jugador.y = -800;
    jugador.x = 275;
    jugador.style.left = '275px';
}

//funcion para crear y posicionar los coches enemigos
function crearEnemigos(coche) {
    var distanciaEntreCoches = 200;
    for (x = 0; x < 5; x++) {
        var enemigo = document.createElement('div');

        enemigo.y = ((x * distanciaEntreCoches) + (x * 100) + 1000) * -1;

        enemigo.style.top = enemigo.y + "px";
        var carril = Math.floor(Math.random() * 5);
        enemigo.x = 100 * carril;
        enemigo.style.left = enemigo.x + "px";

        var aleatorio = Math.floor(Math.random() * 2);
        if (coche == 1) {
            if (aleatorio == 0) {
                var cocheEnemigo = 2;
            } else {
                var cocheEnemigo = 3;
            }
        }
        else if (coche == 2) {
            if (aleatorio == 0) {
                var cocheEnemigo = 1;
            } else {
                var cocheEnemigo = 3;
            }
        } else {
            if (aleatorio == 0) {
                var cocheEnemigo = 1;
            } else {
                var cocheEnemigo = 2;
            }
        }
        enemigo.setAttribute('class', 'enemigo coche' + cocheEnemigo);
        contenedorCoches.appendChild(enemigo);
    }
}

//funcion para mover los enemigos, cuando llegan a su posicion final vuelven arriba
function moverEnemigos() {
    var enemigoN = 0;
    enemigos.forEach(enemigo => {

        if (enemigo.y > enemigoN * -100) {
            enemigo.y = enemigo.y - 1000;

            var carril = Math.floor(Math.random() * 5);
            enemigo.x = 100 * carril;
            enemigo.style.left = enemigo.x + "px";
        }
        enemigo.y += 3;
        enemigo.style.top = enemigo.y + "px";
        enemigoN++;

    });
}

//funcion que se ejecuta cuando el juego esta en marcha
function jugar(jugador) {
    moverEnemigos();
    moverJugador();
    mueveLineas();
    actualizaPuntuacion();
    enemigos.forEach(enemigo => {
        if (colision(enemigo, jugador)) {
            terminarPartida();
        }
    });

}

//actualiza la puntuacion internamente y en pantalla
function actualizaPuntuacion() {
    puntuacion++;
    document.getElementById('puntuacion').innerHTML = "Puntuacion: " + puntuacion;



}

//funcion para terminar la partida
function terminarPartida() {
    clearInterval(intervaloJuego);
    document.getElementById('puntosFinales').innerHTML = puntuacion;
    document.getElementById('enlaceGuardar').setAttribute('href',"/aTodaRueda/guardar/"+puntuacion);
    pantallaFin.setAttribute('class', 'pantallaFin fs-4 text-center');
    
}

//crea y posiciona las lineas de la carretera
function crearlineas() {
    for (y = 1; y < 5; y++) {
        for (x = 0; x < 5; x++) {
            let linea = document.createElement('div');
            linea.setAttribute('class', 'linea');
            linea.y = (x * -150) - 450;
            linea.x = x * -5 + (y * 75) + 23;
            linea.style.left = linea.x + 'px';
            linea.style.top = linea.y + "px";
            carretera.appendChild(linea);
        }
    }
}

//mueve las lineas para que parezca que los coches estan en movimiento
function mueveLineas() {
    let lineas = document.querySelectorAll('.linea');
    lineas.forEach(function (linea) {
        if (linea.y >= -550) {
            linea.y -= 750;
        }
        linea.y += 6;
        linea.style.top = linea.y + "px";
    })
}

//comprueba la colision de dos elementos segun su posicion en pantalla
function colision(a, b) {
    cajaA = a.getBoundingClientRect();
    cajaB = b.getBoundingClientRect();
    return !((cajaA.bottom < cajaB.top) || (cajaA.top > cajaB.bottom) || (cajaA.right < cajaB.left) || (cajaA.left > cajaB.right))
}


