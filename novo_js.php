 <script>
     // codigo java script para lidar com a rodagem dos produtos em destaque e outros mais
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector(".carousel-container");
            const prevBtn = document.querySelector(".prev-btn");
            const nextBtn = document.querySelector(".next-btn");

            const productWidth = container.querySelector(".product-item").offsetWidth + 10; // Largura do produto + espaço entre eles

            nextBtn.addEventListener("click", () => {
                const maxScrollLeft = container.scrollWidth - container.offsetWidth;
                const currentScroll = container.scrollLeft;
                
                if (currentScroll < maxScrollLeft) {
                    container.scrollBy({ left: productWidth * 3, behavior: "smooth" });
                }
            });

            prevBtn.addEventListener("click", () => {
                const currentScroll = container.scrollLeft;
                if (currentScroll > 0) {
                    container.scrollBy({ left: -productWidth * 3, behavior: "smooth" });
                }
            });
        });
        // codigo java script para carregar dinamicamente do banco de dados
      $(document).ready(function() {
    let limit = 6;  // Número de produtos por página
    let start = 0;  // Ponto inicial
    let action = 'inactive';

    function load_products(limit, start) {
        $.ajax({
            url: "<?=ROOT?>fetch_products.php",
            method: "POST",
            data: {limit: limit, start: start},
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(data) {
               
                if (data.trim() === '') {
                    action = 'active';
                } else {
                    $('#product-list').append(data);
                    $('.loading').hide();
                    action = 'inactive';
                }
            }
        });
    }

    if (action === 'inactive') {
        action = 'active';
        load_products(limit, start);
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#product-list").height() && action === 'inactive') {
            action = 'active';
            start += limit;
            setTimeout(function() {
                load_products(limit, start);
            }, 500);
        }
    });
});

        
    </script>