const liastado= document.getElementById("listado");

const item = document.createElement("li");
item.innerHTML = "Item JS";

liastado.append(item)

//---------------------
const input = document.querySelector("input");
const h1 = document.querySelector("h1");
const boton = document.getElementsByTagName("button")[0];

boton.addEventListener("mousemove", butonClick)
input.addEventListener("input", () => {
    if (input.value == "bad word") {
        input.value = "dont type that!"
    }
    h1.innerHTML = input.value
})

function butonClick() {
    console.log("wow you clicked")
}

//--------------------
const form = document.getElementsByTagName("form")[0];

form.addEventListener("submit", (param) => { //Como parametro se pasa el evento en si.
    param.preventDefault //prevenimos que el submit haga su funcion principal, donde uno de los efectos es que no recarge pagina
    let input1 = param.target[0].value //esto nos pilla los tags hijos de a lo que hemos hecho el evento, estos en un array, 
    //luego con fetch mandariamos esto a la API
})


