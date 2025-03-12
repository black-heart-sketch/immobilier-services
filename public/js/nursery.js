document.addEventListener('DOMContentLoaded', function() {
    // Quick view functionality
    document.querySelectorAll('[data-modal-target]').forEach(button => {
        button.addEventListener('click', function() {
            const modalId = this.dataset.modalTarget;
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            
            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
    });

    // Add to cart animation
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('button');
            button.classList.add('animate-bounce');
            setTimeout(() => button.classList.remove('animate-bounce'), 1000);
        });
    });

    // Image hover zoom effect
    document.querySelectorAll('.group').forEach(card => {
        const img = card.querySelector('img');
        card.addEventListener('mousemove', function(e) {
            const { left, top, width, height } = card.getBoundingClientRect();
            const x = (e.clientX - left) / width;
            const y = (e.clientY - top) / height;
            img.style.transform = `scale(1.1) translate(${-x * 10}px, ${-y * 10}px)`;
        });
        card.addEventListener('mouseleave', function() {
            img.style.transform = '';
        });
    });
}); 