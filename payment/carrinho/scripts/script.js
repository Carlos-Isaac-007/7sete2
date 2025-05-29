document.addEventListener("DOMContentLoaded", function () {
    const decreaseBtns = document.querySelectorAll(".decrease");
    const increaseBtns = document.querySelectorAll(".increase");
    const subtotalElement = document.getElementById("subtotal");
    const totalElement = document.getElementById("total");
    const itemQty = document.querySelector(".item-qty");
    const itemPrice = parseFloat(document.querySelector(".item-price").textContent);
    const frete = 10.00;
    
    let quantidade = parseInt(itemQty.textContent);

    function atualizarValores() {
        let subtotal = quantidade * itemPrice;
        let total = subtotal + frete;

        subtotalElement.textContent = `R$ ${subtotal.toFixed(2)}`;
        totalElement.textContent = `R$ ${total.toFixed(2)}`;
    }

    increaseBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            quantidade++;
            itemQty.textContent = quantidade;
            atualizarValores();
        });
    });

    decreaseBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            if (quantidade > 1) {
                quantidade--;
                itemQty.textContent = quantidade;
                atualizarValores();
            }
        });
    });

    atualizarValores();
});