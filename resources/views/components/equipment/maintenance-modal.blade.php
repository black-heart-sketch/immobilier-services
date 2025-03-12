<div x-data="maintenanceModal()"
     x-show="isOpen"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity"
             @click="isOpen = false">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div x-show="isOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            
            <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Demande de Maintenance
                    </h3>

                    <form @submit.prevent="submitForm" class="space-y-4">
                        <!-- Type de maintenance -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de maintenance</label>
                            <select id="type"
                                    x-model="formData.type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                                <option value="routine">Maintenance de routine</option>
                                <option value="repair">Réparation</option>
                                <option value="emergency">Urgence</option>
                            </select>
                        </div>

                        <!-- Priorité -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Niveau de priorité</label>
                            <select id="priority"
                                    x-model="formData.priority"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                                <option value="low">Basse</option>
                                <option value="medium">Moyenne</option>
                                <option value="high">Haute</option>
                                <option value="critical">Critique</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description du problème</label>
                            <textarea id="description"
                                    x-model="formData.description"
                                    rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                        </div>

                        <!-- Date souhaitée -->
                        <div>
                            <label for="scheduled_date" class="block text-sm font-medium text-gray-700">Date souhaitée</label>
                            <input type="date"
                                   id="scheduled_date"
                                   x-model="formData.scheduled_date"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        </div>

                        <!-- Contact -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="reported_by" class="block text-sm font-medium text-gray-700">Votre nom</label>
                                <input type="text"
                                       id="reported_by"
                                       x-model="formData.reported_by"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                            </div>
                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="tel"
                                       id="contact_phone"
                                       x-model="formData.contact_phone"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-600 focus:ring-primary-600">
                            </div>
                        </div>

                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm"
                                    :disabled="isSubmitting">
                                <span x-show="!isSubmitting">Soumettre la demande</span>
                                <span x-show="isSubmitting">
                                    <i class="fas fa-circle-notch fa-spin mr-2"></i>
                                    Traitement...
                                </span>
                            </button>
                            <button type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto sm:text-sm"
                                    @click="isOpen = false">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function maintenanceModal() {
    return {
        isOpen: false,
        isSubmitting: false,
        formData: {
            type: 'routine',
            priority: 'medium',
            description: '',
            scheduled_date: '',
            reported_by: '',
            contact_phone: ''
        },
        async submitForm() {
            this.isSubmitting = true;
            try {
                const response = await fetch(`/equipment/${this.equipmentId}/maintenance`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(this.formData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.isOpen = false;
                    alert('Votre demande de maintenance a été enregistrée avec succès.');
                    window.location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            } finally {
                this.isSubmitting = false;
            }
        }
    }
}
</script>
@endpush 