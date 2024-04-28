@if(session()->has('success_c'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_c')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
@if(session()->has('success_cc'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_cc')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
  @if(session()->has('success_u'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_u')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
  @if(session()->has('success_uu'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_uu')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
  @if(session()->has('success_d'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_d')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
  @if(session()->has('success_dd'))
<div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{session('success_dd')}}</p> {{--{{session()->get('success')}}--}}
  </div>
  @endif
  @if(session()->has('success_email'))
  <div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 4000)" 
      x-show="show" 
      class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-indigo-500 text-white py-2 px-4 rounded-xl shadow-lg text-sm z-50"
      style="transition: all 0.5s ease-in-out;">
    <p>{{ session('success_email') }}</p>
  </div>
@endif