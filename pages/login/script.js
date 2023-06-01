// by Romullo
const pass = document.querySelector("#password")
pass.addEventListener("keyup", (e) => { handle(e) })

console.log("%c By Romullo", "color: red; font-size: 40px; font-weight: bold; background: yellow");

function handle({ key }) {
    const letter = document.querySelector("#letra"),
        number = document.querySelector("#numero"),
        symbol = document.querySelector("#simbolo"),
        char = document.querySelector("#caracteres")

    if (/[a-zA-Z]/.test(pass.value)) {
        letter.classList.add("itHas")
    }
    else {
        letter.classList.remove("itHas")
    }

    if (/[0-9]/.test(pass.value)) {
        number.classList.add("itHas")
    }
    else {
        number.classList.remove("itHas")
    }
    if (/[@#!$%¨&*()\-\_\=\+]/.test(pass.value)) {
        symbol.classList.add("itHas")
    }
    else {
        symbol.classList.remove("itHas")
    }

    if (pass.value.length > 8) {
        char.classList.add("itHas")
    }
    else {
        char.classList.remove("itHas")
    }
}



// by Romullo