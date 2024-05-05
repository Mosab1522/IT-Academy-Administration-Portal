@props(['url','itemName','delete' => true])

<td class="py-3 px-6 text-right tracking-wider lg:px-6 lg:py-3">
    @if ($attributes->get('edit'))
        <a href="/admin/{{$url}}" class="material-icons p-2 sm:p-1 text-blue-600 hover:text-blue-700 border border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">settings</a>
    @endif
    @if($delete)
    <form action="/admin/{{$url}}" id="deleteForm" method="POST" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete('{{$itemName}}', '/admin/{{$url}}')" class="material-icons p-2 sm:p-1 text-red-600 hover:text-red-700 border-2 border-gray-200 rounded-md sm:border-0 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">delete</button>
    </form>
    @endif
</td>




