@extends('layouts.master')

@section('content')

<script type="text/javascript">
	$(function() {
		$('#name').focus(); 
	});
</script>

@if ($editMode == true)
{{ Form::model($customField, array('route' => array('customFields.update', $customField->id), 'class' => 'form-horizontal')) }}
@else
{{ Form::open(array('route' => 'customFields.store', 'class' => 'form-horizontal')) }}
@endif

<aside class="right-side">                

	<section class="content-header">
		<h1 class="pull-left">
			{{ trans('fi.custom_field_form') }}
		</h1>
		<div class="pull-right">
			{{ Form::submit(trans('fi.save'), array('class' => 'btn btn-primary')) }}
		</div>
		<div class="clearfix"></div>
	</section>

	<section class="content">

		@include('layouts._alerts')

		<div class="row">

			<div class="col-md-12">

				<div class="box box-primary">
					
					<div class="box-body">

						<div class="form-group">
							<label>{{ trans('fi.table_name') }}: </label>
							@if ($editMode == true)
							{{ Form::text('table_name', $tableNames[$customField->table_name], array('id' => 'table_name', 'readonly' => 'readonly', 'class' => 'form-control')) }}
							@else
							{{ Form::select('table_name', $tableNames, null, array('id' => 'table_name', 'class' => 'form-control')) }}
							@endif
						</div>

						<div class="form-group">
							<label>{{ trans('fi.field_label') }}: </label>
							{{ Form::text('field_label', null, array('id' => 'field_label', 'class' => 'form-control')) }}
						</div>

						<div class="form-group">
							<label>{{ trans('fi.field_type') }}: </label>
							{{ Form::select('field_type', $fieldTypes, null, array('id' => 'field_type', 'class' => 'form-control')) }}
						</div>

						<div class="form-group">
							<label>{{ trans('fi.field_meta') }}: </label>
							{{ Form::text('field_meta', null, array('id' => 'field_meta', 'class' => 'form-control')) }}
							<span class="help-block">{{ trans('fi.field_meta_description') }}</span>
						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

</aside>

{{ Form::close() }}
@stop