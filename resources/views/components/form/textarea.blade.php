@props(['name', 'title', 'placeholder','errorBag' => 'default', 'required' => false  ])
   
    <x-form.label name="{{$name}}" title="{{$title}}"/>
    <textarea  class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm resize-none overflow-hidden" name="{{$name}}" id="{{$name}}" placeholder="{{$placeholder}}"
    oninput="autoExpand(this)"  @if($required)
    required
@endif rows="3">{{$slot ?? old($name)}}</textarea>
    <x-form.error name="{{$name}}" errorBag="{{$errorBag}}"/>



    

