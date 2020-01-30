{{-- <div id="field_{{ $id }}" class="form-group">
    <label for="{{ $id }}"{!! Html::classes(['text-danger' => $hasErrors]) !!}>
        {{ $label }}
@if ($required)
        <span class="badge badge-info">Required</span>
@endif
    </label>
    {!! $input !!}
@foreach ($errors as $error)
    <div class="invalid-feedback">{{ $error }}</div>
@endforeach
</div> --}}


@isset ($attributes['grid'])
    <div class="{{ $attributes['grid'] }}">
@endif

<div id="field_{{ $id }}" class="{{ $label != false ? 'form-group' : null }}" style="position: relative;">
    @if ($label != false)
        <label for="{{ $id }}"{!! Html::classes(['text-danger' => $hasErrors]) !!}>
            {{ $label }}
            @if ($required)
                    <span class="badge badge-info">Required</span>
            @endif
        </label>

        @if (isset($attributes['modal']) and $type == 'select')
            @php if (! isset($attributes['privileges'])) $attributes['privileges'] = 'all'; @endphp

            <div style="position: absolute; top: 0; right: 0">
                @if (@$attributes['privileges'] == 'all' or @$attributes['privileges'] == 'create')
                    <span id="btn_create_{{ $id }}" class="color-morado glyphicon glyphicon-plus" onclick="{{ $attributes['object-modal'] }}.prepareToCreate()" data-toggle="modal" data-target="#modal_create_{{ $attributes['modal'] }}" title="Crear" style="cursor: pointer;"></span>
                @endif
                @if (@$attributes['privileges'] == 'all' or @$attributes['privileges'] == 'edit')
                    <span id="brn_edit_{{ $id }}" class="color-morado glyphicon glyphicon-pencil" onclick="{{ $attributes['object-modal'] }}.prepareToEdit()" data-toggle="modal" data-target="#modal_edit_{{ $attributes['modal'] }}" title="Editar" style="cursor: pointer; margin-left: 7px"></span>
                @endif
            </div>
        @endif
    @endif

    {!! $input !!}

@php
    if ($multiple) $name = str_replace('[', '', str_replace(']', '', $name));
@endphp

@foreach ((array) $errors as $error_aux)
    <div class="invalid-feedback" style="color: #E74C3C; font-size: small;">{{ ! is_array($error_aux) ? $error_aux : null }}</div>
@endforeach

    @if (isset($extra['coin']) and $extra['coin'] == true)
        <script>
            new InputCoin('{{ $id }}', '{{ $extra['precision'] }}');
        </script>
    @endif

    @if (isset($attributes['coincidences']) and $type == 'text')
            @include('partials.coincidences', ['id' => $attributes['coincidences']])
    @endif

</div>

@isset ($attributes['grid'])
    </div>
@endif

@if(@$extra['date'] == 'date')
	<script type="text/javascript">
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		$(".datepicker").datepicker();
	</script>
@endif
