@props(['url','itemName'])

<td class="px-3 py-4 text-right lg:px-6 lg:py-4">
   
    <a href="/admin/{{$url}}" class="material-icons p-2 sm:p-1 text-blue-600 hover:text-blue-700 border border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">settings</a>
    
    @if ($attributes->get('delete'))
    <form id="deleteForm" method="POST" class="inline-block sm:mt-0 mt-2" >
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete('{{$itemName}}', '/admin/{{$url}}')" class="delete-button material-icons p-2 sm:p-1 text-red-600 hover:text-red-700 border border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">delete</button>
    </form>
    @endif
</td>

<div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center" style="display: none;">
    <!-- Modal -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-900">Potvrdiť vymazanie</h2>
        <p class="text-gray-700">Ste si istý že chcete vymazať <span id="itemToDeleteName"></span>?</p>
        <div class="flex justify-end space-x-4 mt-4">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-md hover:bg-gray-400">Zrušiť</button>
            <button id="confirmButton" onclick="confirmDeletion()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Vymazať</button>

        </div>
    </div>
</div>
<script>
    // Variable to store the countdown timeout ID
    let countdown;
    
    // Function to open the modal and start a countdown
    function confirmDelete(itemName, url) {
        document.getElementById('itemToDeleteName').textContent = itemName;
        document.getElementById('deleteConfirmModal').style.display = 'flex';  // Show the modal
    
        // Start the countdown timer
        const confirmButton = document.getElementById('confirmButton');
        let timeLeft = 10;  // 10 seconds countdown
        confirmButton.textContent = `Delete (${timeLeft}s)`;
    
        countdown = setInterval(() => {
            timeLeft--;
            confirmButton.textContent = `Delete (${timeLeft}s)`;
            if (timeLeft <= 0) {
                closeModal();
            }
        }, 1000);  // Update every second
    }
    
    // Function to close the modal
    function closeModal() {
        clearInterval(countdown);  // Stop the countdown
        document.getElementById('deleteConfirmModal').style.display = 'none';
    }
    
    // Attach click event listener to the modal overlay
    document.getElementById('deleteConfirmModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeModal();
        }
    });
    
    // Attach the actual deletion function
    window.confirmDeletion = function() {
        clearInterval(countdown);  // Stop the countdown
        document.getElementById('deleteForm').action = url;  // Set the action URL dynamically
        document.getElementById('deleteForm').submit();      // Submit the form
    }
    </script>
    