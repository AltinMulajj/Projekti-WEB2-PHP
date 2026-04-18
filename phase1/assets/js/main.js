// ============================================================
// 1. CAROUSEL
// ============================================================
function setupCarousel(trackId, leftBtnClass, rightBtnClass) {
  const track = document.querySelector(trackId);
  const btnLeft = document.querySelector(leftBtnClass);
  const btnRight = document.querySelector(rightBtnClass);

  if (!track || !btnLeft || !btnRight) return;

  let scrollAmount = 0;

  const updateCardWidth = () => {
    const card = track.querySelector(":scope > div");
    return card.offsetWidth + 10;
  };

  btnRight.addEventListener("click", () => {
    const cardWidth = updateCardWidth();
    const maxScroll = track.scrollWidth - track.clientWidth;
    scrollAmount = Math.min(scrollAmount + cardWidth * 4, maxScroll);
    track.style.transform = `translateX(-${scrollAmount}px)`;
  });

  btnLeft.addEventListener("click", () => {
    const cardWidth = updateCardWidth();
    scrollAmount = Math.max(scrollAmount - cardWidth * 4, 0);
    track.style.transform = `translateX(-${scrollAmount}px)`;
  });
}

setupCarousel("#carouselTrack1", ".left1", ".right1");
setupCarousel("#carouselTrack2", ".left2", ".right2");

// ============================================================
// 2. CART — Add to Cart + Quantity logic
// ============================================================
function getCart() {
  return JSON.parse(localStorage.getItem("cart")) || [];
}

function saveCart(cart) {
  localStorage.setItem("cart", JSON.stringify(cart));
}

document.addEventListener("click", function (e) {
  const btn = e.target.closest(".add-to-cart");
  if (!btn) return;

  e.preventDefault();

  const id    = btn.dataset.id;
  const name  = btn.dataset.name;
  const price = Number(btn.dataset.price);
  const img   = btn.dataset.img;

  if (!id || !name || !price || !img) return;

  let cart = getCart();
  let product = cart.find(p => p.id === id);

  if (product) {
    product.quantity += 1;
  } else {
    cart.push({ id, name, price, img, quantity: 1 });
  }

  saveCart(cart);
  alert(name + " u shtua në cart!");
});

// ============================================================
// 3. CONTACT POPUP
// ============================================================
document.addEventListener("DOMContentLoaded", () => {
  const form     = document.querySelector(".contact-form");
  const popup    = document.getElementById("successPopup");
  const closeBtn = document.getElementById("closePopup");

  if (!form || !popup || !closeBtn) return;

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    popup.classList.add("active");
    form.reset();
  });

  closeBtn.addEventListener("click", () => {
    popup.classList.remove("active");
  });
});