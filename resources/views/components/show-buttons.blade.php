@props(['calendarText', 'calendarWho', 'emailId', 'emailType', 'emailText', 'pick' => false, 'email' => true])
<div class="ml-auto mt-1.5 flex space-x-4">
    <button title="Kalendár" class="text-gray-800 hover:text-gray-600"
        onclick="showCalendarModal('{{ $calendarText }}','{{ $calendarWho }}')">
        <span class="material-icons material-icons-header">event</span>
    </button>
    @if ($email)
        <button title="Poslať email" class="email-button text-gray-800 hover:text-gray-600"
            data-recipient-id="{{ $emailId }}" data-type="{{ $emailType }}" data-text="{{ $emailText }}"
            data-pick="{{ $pick }}">
            <span class="material-icons material-icons-header">email</span>
        </button>
    @endif

    {{ $slot }}
</div>
