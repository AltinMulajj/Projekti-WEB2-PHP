document.addEventListener("DOMContentLoaded", function () {
    
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

                fetch("../api/products-api.php", {
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

            fetch("../api/cart-api.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
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