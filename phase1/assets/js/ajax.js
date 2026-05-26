document.addEventListener("DOMContentLoaded", function () {
    const apiBase = "/Projekti-WEB2-PHP/phase1/api/";
    const deleteButtons = document.querySelectorAll(".ajax-delete-btn");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const productId = this.getAttribute("data-id");
            const rowToRemove = document.getElementById("product-row-" + productId);

            if (confirm("A jeni të sigurt që dëshironi ta fshini këtë produkt me AJAX?")) {
                const formData = new FormData();
                formData.append("id", productId);
                formData.append("action", "delete");

                fetch(apiBase + "products-api.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (rowToRemove) { rowToRemove.remove(); }
                        alert(data.message);
                    } else {
                        alert("Gabim: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Gabim:", error);
                    alert("Ndodhi një gabim gjatë lidhjes.");
                });
            }
        });
    });

    const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault(); 

            const productId = this.getAttribute("data-id");

            const formData = new FormData();
            formData.append("product_id", productId);
            formData.append("action", "add");

           fetch(apiBase + "cart-api.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];

const existing = cart.find(item => item.id === productId);

if (existing) {
    existing.quantity++;
} else {
    cart.push({
        id: productId,
        name: button.getAttribute("data-name"),
        price: button.getAttribute("data-price"),
        img: button.getAttribute("data-img"),
        quantity: 1
    });
}

localStorage.setItem("cart", JSON.stringify(cart));
                    alert(data.message);
                    
                    const cartCountElement = document.getElementById("cart-count");
                    if (cartCountElement) {
                        cartCountElement.innerText = data.totalItems;
                    }
                } else {
                    alert("Gabim: " + data.message);
                }
            })
            .catch(error => {
                console.error("Gabim te shporta:", error);
                alert("Ndodhi një gabim gjatë shtimit në shportë.");
            });
        });
    });

});