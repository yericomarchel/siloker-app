{{-- resources/views/components/forms/text-input.blade.php --}}

@props(['name', 'label', 'type' => 'text', 'value' => '', 'required' => false, 'placeholder' => '', 'class' => ''])

<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-2 {{ $class }}" {{-- TAMBAHKAN px-3 py-2 DI SINI --}}
        value="{{ old($name, $value) }}"
        @if ($required) required @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $attributes }}
    />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
