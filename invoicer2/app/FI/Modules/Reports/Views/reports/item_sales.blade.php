@extends('layouts.master')

@section('jscript')

@include('layouts._datemask')

<script type="text/javascript">
	$(function() {
		$('#btn-run-report').click(function() {

			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();

			$.post("{{ route('reports.itemSales.ajax.validate') }}", {
				from_date: from_date,
				to_date: to_date
			}).done(function() {
				clearErrors();
				$('#form-validation-placeholder').html('');
				output_type = $("input[name=output_type]:checked").val();
				query_string = "?from_date=" + from_date + "&to_date=" + to_date;
				if (output_type == 'preview') {
					$('#preview').show();
					$('#preview-results').attr('src', "{{ route('reports.itemSales.html') }}" + query_string);
				}
				else if (output_type == 'pdf') {
					window.open("{{ route('reports.itemSales.pdf') }}" + query_string);
				}

			}).fail(function(response) {
				showErrors($.parseJSON(response.responseText).errors, '#form-validation-placeholder');
			});
		});

		$("#from_date").inputmask("{{ Config::get('fi.datepickerFormat') }}");
		$("#to_date").inputmask("{{ Config::get('fi.datepickerFormat') }}");
	});
</script>
@stop

@section('content')

<aside class="right-side">

	<section class="content-header">
		<h1>{{ trans('fi.item_sales') }}</h1>
	</section>

	<section class="content">

		<div id="form-validation-placeholder"></div>

		<div class="row">

			<div class="col-md-12">

				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">{{ trans('fi.options') }}</h3>
					</div>
					<div class="box-body">

						<div class="row">

							<div class="col-xs-2">
								<label>{{ trans('fi.from_date') }}</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{{ Form::text('from_date', null, array('id' => 'from_date', 'class' => 'form-control')) }}
								</div>
							</div>
							<div class="col-xs-2">
								<label>{{ trans('fi.to_date') }}</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									{{ Form::text('to_date', null, array('id' => 'to_date', 'class' => 'form-control')) }}
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="input-group">
									<label>{{ trans('fi.output_type') }}</label><br>
									<label class="radio-inline">
										<input type="radio" name="output_type" value="preview" checked="checked"> {{ trans('fi.preview') }}
									</label>
									<label class="radio-inline">
										<input type="radio" name="output_type" value="pdf"> {{ trans('fi.pdf') }}
									</label>
								</div>
							</div>
						</div>

						<br>

						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-primary" id="btn-run-report">{{ trans('fi.run_report') }}</button>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>

		<div class="row" id="preview" style="height: 100%; background-color: #e6e6e6; padding: 25px; margin: 0px; display: none;">
			<div class="col-lg-8 col-lg-offset-2" style="background-color: white;">
				<iframe src="about:blank" id="preview-results" frameborder="0" style="width: 100%;" scrolling="no" onload="javascript:resizeIframe(this, 500);"></iframe>
			</div>
		</div>

	</section>

</aside>

@stop