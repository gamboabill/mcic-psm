@props(['type', 'message', 'timeout' => '5000'])

@if(session()->has($type))

<div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, {{$timeout}})"
    class="fixed top-5 right-5 text-sm p-4 text-white rounded-lg shadow-lg z-50 {{ $type == 'success' ? 'bg-green-600 text-white'  : 'bg-red-600 text-white'}}">
    {{$message}}
</div>

@endif