@extends('layouts.empty')

@section('jscript')
<script type="text/javascript">
	$(function() {

		$('#btn-run-migration').click(function() {

			$('#btn-run-migration').hide();
			$('#btn-running-migration').show();

		// $('#btn-run-migration')
		// .attr('disabled', 'disabled')
		// .html('{{ trans('fi.installing_please_wait') }}');

		$.post('{{ route('setup.postMigration') }}', function(response) {

			if (response.exception) {
				$('#div-exception').show().html(response.exception);

				$('#btn-running-migration').hide();
				$('#btn-run-migration').show();

			}
			else if (response.code == 0) {

				$('#div-exception').hide();

				$('#btn-running-migration').hide();
				$('#btn-migration-complete').show();

			}
			else {

				$('#btn-running-migration').hide();
				$('#btn-run-migration').show();

				$('#div-exception').show().html(response.code);

			}

		});
	});

	});
</script>
@stop

@section('content')

<aside class="right-side">                

	<section class="content-header">
		<h1>{{ trans('fi.database_setup') }}</h1>
	</section>

	<section class="content">

		<div class="row">

			<div class="col-md-12">

				<div class="box box-primary">
					
					<div class="box-body">

						<div class="alert alert-error" id="div-exception" style="display: none;"></div>

						<p>{{ trans('fi.step_database_setup') }}</p>

						<a class="btn btn-primary" id="btn-run-migration">{{ trans('fi.continue') }}</a>

						<a class="btn btn-default" id="btn-running-migration" style="display: none;" disabled="disabled">{{ trans('fi.installing_please_wait') }}</a>

						<a href="{{ route('setup.account') }}" class="btn btn-success" id="btn-migration-complete" style="display: none;">{{ trans('fi.continue') }}</a>

					</div>

				</div>

			</div>

		</div>

	</section>

</aside>
@stop