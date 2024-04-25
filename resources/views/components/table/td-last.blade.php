@props(['url','itemName'])

<td class="px-3 py-4 text-right lg:px-6 lg:py-4">
   @if ($attributes->get('edit'))
    <a href="/admin/{{$url}}" class="material-icons p-2 sm:p-1 text-blue-600 hover:text-blue-700 border border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">settings</a>
    @endif
    
    <form id="deleteForm" method="POST" class="inline-block sm:mt-0 mt-2" >
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete('{{$itemName}}', '/admin/{{$url}}')" class="delete-button material-icons p-2 sm:p-1 text-red-600 hover:text-red-700 border border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">delete</button>
    </form>
    
</td>

