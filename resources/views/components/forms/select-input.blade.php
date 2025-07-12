{{-- resources/views/components/forms/select-input.blade.php --}}

@props(['name', 'label', 'options', 'selected' => '', 'required' => false, 'placeholder' => 'Pilih...', 'class' => ''])

<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm {{ $class }}"
        @if ($required) required @endif
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $key => $text)
            <option value="{{ $key }}" @selected(old($name, $selected) == $key)>
                {{ $text }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
