let card = document.querySelector('.card');
let btnlogin = document.querySelector('.btnLogin');
let btnCadastro = document.querySelector('.btnCadastro');
const isDesktop = () => window.innerWidth >= 1024;

btnlogin.onclick = () => {
    card.classList.remove('cadastroActive');
    card.classList.add('loginActive');
    if (!isDesktop()) {
        document.querySelector('.direita').style.marginTop = '0px';
        document.querySelector('.direita').style.height = '230px';
        document.querySelector('.esquerda').style.marginTop = '0px';
    }
}

btnCadastro.onclick = () => {
    card.classList.remove('loginActive');
    card.classList.add('cadastroActive');

    if (!isDesktop()) {
        document.querySelector('.direita').style.marginTop = '10px';
        document.querySelector('.direita').style.height = '350px';
        document.querySelector('.esquerda').style.marginTop = '230px';
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth' // opcional: para rolagem suave
        });
    }
}
