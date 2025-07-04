let card = document.querySelector('.card');
let btnlogin = document.querySelector('.btnLogin');
let btnCadastro = document.querySelector('.btnCadastro');

btnlogin.onclick = () => {
    card.classList.remove('cadastroActive');
    card.classList.add('loginActive');
}

btnCadastro.onclick = () => {
    card.classList.remove('loginActive');
    card.classList.add('cadastroActive');
    document.querySelector('.formCadastro').style.marginTop = '170px';
    document.querySelector('.direita').style.height = '350px';
}