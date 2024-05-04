@props([
    'calendarText',
    'calendarWho',
    'emailId',
    'emailType',// Default empty if not provided
    'emailText',
    'pick' => false
    // Default to the 'default' error bag
])
<div class="ml-auto mt-1.5 flex space-x-4">
    <!-- Calendar Icon -->
    <button title="Kalendár" class="text-gray-800 hover:text-gray-600" onclick="showCalendarModal('{{$calendarText}}','{{$calendarWho}}')">
        <span class="material-icons material-icons-header">event</span>
    </button>

    <!-- Email Icon -->
    <button title="Poslať email" class="email-button text-gray-800 hover:text-gray-600" data-recipient-id="{{$emailId}}" data-type="{{$emailType}}" data-text="{{$emailText}}" data-pick="{{$pick}}">
        <span class="material-icons material-icons-header">email</span>
    </button>

   {{$slot}}
</div>