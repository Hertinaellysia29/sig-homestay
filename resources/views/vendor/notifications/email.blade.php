@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Halo!')
@endif
@endif

{{-- Intro Lines --}}
{{-- @foreach ($introLines as $line)
{{ $line }} --}}

{{-- @endforeach --}}
@lang('Anda menerima email ini karena kami menerima permintaan Reset Password untuk akun Anda.')

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
@lang('Reset Password')
@endcomponent
@endisset

{{-- Outro Lines --}}
{{-- @foreach ($outroLines as $line)
{{ $line }} --}}
@lang('Link Reset Password ini akan kaladuarsa dalam waktu 60 menit.')<br><br>
@lang('Jika Anda tidak meminta Reset Password, tidak diperlukan tindakan lebih lanjut.')

{{-- @endforeach --}}

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Salam'),<br>
@lang('SIG Homestay Balige')
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Jika anda kesulitan menekan tombol \"Reset Password\" di atas, salin dan tempel URL di bawah ini\n".
    'ke browser web Anda:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
