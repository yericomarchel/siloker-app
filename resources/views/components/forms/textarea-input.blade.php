{{-- resources/views/components/forms/textarea-input.blade.php --}}

@props(['name', 'label', 'value' => '', 'required' => false, 'placeholder' => '', 'rows' => 3, 'class' => ''])

<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2 {{ $class }}" {{-- PASTIKAN 'px-3 py-2' ADA DI SINI --}}
        @if ($required) required @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
