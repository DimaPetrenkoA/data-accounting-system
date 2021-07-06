@component($typeForm, get_defined_vars())
    <span {{ $attributes }}>

        @isset($icon)
            <x-orchid-icon :path="$icon" class="{{ empty($name) ?: 'mr-2'}}"/>
        @endisset

        {{ $name ?: '' }}
    </span>
@endcomponent
