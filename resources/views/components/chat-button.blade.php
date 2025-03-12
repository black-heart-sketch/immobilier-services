<div x-data="{ isOpen: false }" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button @click="isOpen = !isOpen" 
            class="bg-primary-600 text-white w-16 h-16 rounded-full shadow-lg hover:bg-primary-700 transition-colors duration-200 flex items-center justify-center group">
        <i class="fas" :class="isOpen ? 'fa-times' : 'fa-comments'"></i>
        <!-- Tooltip -->
        <span class="absolute right-full mr-4 bg-gray-900 text-white text-sm py-2 px-4 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
            Discuter avec notre assistant
        </span>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="absolute bottom-20 right-0 w-96 bg-white rounded-xl shadow-2xl overflow-hidden">
        
        <!-- Chat Header -->
        <div class="bg-primary-600 text-white p-4">
            <h3 class="font-semibold text-lg">Assistant Virtuel</h3>
            <p class="text-sm text-primary-100">Comment puis-je vous aider ?</p>
        </div>

        <!-- Chat Messages -->
        <div class="h-96 overflow-y-auto p-4 space-y-4" id="chat-messages">
            <!-- Welcome Message -->
            <div class="flex items-start">
                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-primary-600"></i>
                </div>
                <div class="ml-3 bg-gray-100 rounded-lg py-2 px-4 max-w-[80%]">
                    <p class="text-gray-800">Bonjour ! Je suis votre assistant virtuel. Comment puis-je vous aider aujourd'hui ?</p>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t p-4">
            <form @submit.prevent="sendMessage" id="chat-form" class="flex gap-2">
                <input type="text" 
                       id="chat-input"
                       placeholder="Écrivez votre message..." 
                       class="flex-1 rounded-lg border-gray-300 focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                <button type="submit" 
                        class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
        messages: [],
        
        async sendMessage(event) {
            const form = event.target;
            const input = form.querySelector('#chat-input');
            const message = input.value.trim();
            
            if (!message) return;
            
            // Add user message
            this.addMessage(message, 'user');
            input.value = '';

            try {
                const response = await fetch('{{ route("chatbot.message") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message })
                });

                const data = await response.json();
                
                // Add bot response
                this.addMessage(data.response, 'bot');
                
            } catch (error) {
                console.error('Error:', error);
                this.addMessage('Désolé, une erreur est survenue.', 'bot');
            }
        },

        addMessage(content, type) {
            const messagesDiv = document.getElementById('chat-messages');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start ' + (type === 'user' ? 'justify-end' : '');
            
            messageDiv.innerHTML = type === 'user' 
                ? `
                    <div class="mr-3 bg-primary-600 text-white rounded-lg py-2 px-4 max-w-[80%]">
                        <p>${content}</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                `
                : `
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-robot text-primary-600"></i>
                    </div>
                    <div class="ml-3 bg-gray-100 rounded-lg py-2 px-4 max-w-[80%]">
                        <p class="text-gray-800">${content}</p>
                    </div>
                `;
            
            messagesDiv.appendChild(messageDiv);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
    }));
});
</script>
@endpush 