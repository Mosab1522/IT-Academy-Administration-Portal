@props(['name','title','required' => false])
<label class="block text-sm font-medium text-gray-700" for="{{$name}}">{{$title}} @if($required )<span class="text-red-500">*</span>@endif</label>