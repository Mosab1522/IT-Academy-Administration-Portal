@props(['heading'])
<div class="flex h-full">
    <x-aside/> 
<div class="min-h-screen bg-gray-100 py-6 flex-1 flex-col justify-center sm:py-12">
  
  <div class="relative py-3 sm:max-w-3xl sm:mx-auto">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-300 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-lg"></div>
    <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-lg sm:p-20">
        
      <div class="max-w-3xl mx-auto">
        
        <div>
          <h1 class="text-2xl font-semibold text-gray-900">{{$heading}}</h1>
        </div>
        <div class="divide-y divide-gray-200"> 
            
          {{$slot}}
        </div>
      </div>
    </div>
  </div>
</div>
</div>
