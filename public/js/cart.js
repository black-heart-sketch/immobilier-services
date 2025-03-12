document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    document.querySelectorAll('[data-add-to-cart]').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const plantId = this.dataset.plantId;
            const quantity = this.querySelector('[name="quantity"]').value;
            
            try {
                const response = await fetch(`/cart/${plantId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity: parseInt(quantity) })
                });

                const data = await response.json();
                
                if (data.success) {
                    // Show success toast
                    const toast = document.getElementById('toast');
                    toast.textContent = 'Produit ajouté au panier';
                    toast.classList.remove('translate-y-full', 'opacity-0');
                    
                    // Update cart count if it exists
                    const cartCount = document.querySelector('[data-cart-count]');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                    }

                    // Hide toast after 3 seconds
                    setTimeout(() => {
                        toast.classList.add('translate-y-full', 'opacity-0');
                    }, 3000);
                }
            } catch (error) {
                console.error('Error:', error);
                // Show error toast
                const toast = document.getElementById('toast');
                toast.textContent = 'Erreur lors de l\'ajout au panier';
                toast.classList.remove('translate-y-full', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('translate-y-full', 'opacity-0');
                }, 3000);
            }
        });
    });
}); 