document.addEventListener('DOMContentLoaded', function() {
    const updateCartCount = (count) => {
        const cartCountElements = document.querySelectorAll('[data-cart-count]');
        cartCountElements.forEach(element => {
            element.textContent = count;
            element.classList.toggle('hidden', count === 0);
        });
    };

    const updateCartTotal = () => {
        fetch('/cart/total')
            .then(response => response.json())
            .then(data => {
                document.querySelectorAll('[data-cart-total]').forEach(element => {
                    element.textContent = data.total;
                });
            });
    };

    // Add to cart
    document.querySelectorAll('[data-add-to-cart]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const plantId = form.dataset.plantId;
            const quantity = form.querySelector('[name="quantity"]').value;

            fetch(`/cart/${plantId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCount(data.cart_count);
                    // Show success message
                    const toast = document.getElementById('toast');
                    toast.textContent = data.message;
                    toast.classList.remove('hidden');
                    setTimeout(() => toast.classList.add('hidden'), 3000);
                }
            });
        });
    });

    // Update quantity
    document.querySelectorAll('[data-action="update-quantity"]').forEach(select => {
        select.addEventListener('change', function() {
            const itemId = this.closest('li').dataset.itemId;
            fetch(`/cart/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: this.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCount(data.cart_count);
                    updateCartTotal();
                }
            });
        });
    });

    // Remove item
    document.querySelectorAll('[data-action="remove-item"]').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.closest('li').dataset.itemId;
            const item = this.closest('li');

            fetch(`/cart/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    item.remove();
                    updateCartCount(data.cart_count);
                    updateCartTotal();
                    
                    // If cart is empty, refresh the page
                    if (data.cart_count === 0) {
                        window.location.reload();
                    }
                }
            });
        });
    });
}); 