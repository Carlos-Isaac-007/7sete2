<style>
    
    
     /* Efeito de fogo ardendo */
    .fire-icon i {
      color: orange;
      animation: flame 1.5s infinite alternate;
    }

    @keyframes flame {
      0% {
        transform: scale(1) rotate(0deg);
        color: orange;
        text-shadow: 0 0 5px red, 0 0 10px orange, 0 0 15px yellow;
      }
      50% {
        transform: scale(1.1) rotate(10deg);
        color: yellow;
        text-shadow: 0 0 10px red, 0 0 15px orange, 0 0 20px yellow;
      }
      100% {
        transform: scale(1) rotate(-10deg);
        color: red;
        text-shadow: 0 0 5px orange, 0 0 10px red, 0 0 15px yellow;
      }
    }
  
   /* 1. Linha animada */
  .titulo-com-linha {
    display: inline-block;
    position: relative;
    font-size: 1.6rem;
  }

  .titulo-com-linha::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0;
    height: 1px;
    background-color: orange;
    transition: width 3s ease;
  }

  .titulo-com-linha.aparecer::after {
    width: 100%;
  }

 
  /* 3. Gradiente animado */
  .gradiente-brilho {
    font-size: 1.8rem;
    font-weight: bold;
    background: linear-gradient(90deg, #00c853, #00e5ff, #00c853);
    background-size: 200%;
    color: transparent;
    background-clip: text;
    -webkit-background-clip: text;
    animation: brilho 3s linear infinite;
  }

  @keyframes brilho {
    0% { background-position: 0% }
    100% { background-position: 200% }
  }

  /* 4. Letra por letra */
  .letra-animada span {
    display: inline-block;
    opacity: 0;
    transform: translateY(10px);
    animation: letraSubir 0.5s forwards;
  }

  @keyframes letraSubir {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  #home_box {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    position: relative;
  }

   /*#home_box::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7); /* Ajuste aqui a opacidade (0.4 = 40% escuro) 
    z-index: 1;
  }*/

  /* Para garantir que o conteúdo fique acima do overlay */
  #home_box > * {
    position: relative;
    z-index: 2;
  }
  #home_box{
       transition: background-color 0.5s ease-in-out;
  }

</style>