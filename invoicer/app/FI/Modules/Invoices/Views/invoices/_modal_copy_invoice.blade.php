<script type="text/javascript">
    var clientNameLookupRoute = '{{ route('clients.ajax.nameLookup') }}';
    var copyInvoiceRoute        = '{{ route('invoices.ajax.copyInvoice') }}';
    var userId                = {{ $user_id }};
    var copyInvoiceReturnUrl    = '{{ url('invoices') }}';
</script>

<script src="{{ asset('js/FI/invoice_copy.js') }}" type="text/javascript"></script>

<div class="modal fade" id="modal-copy-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('fi.copy_invoice') }}</h4>
            </div>
            <div class="modal-body">

                <div id="modal-status-placeholder"></div>

                <form class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.client') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('client_name', $invoice->client->name, array('id' => 'copy_client_name', 'class' => 'form-control client-lookup', 'autocomplete' => 'off')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.invoice_date') }}</label>
                        <div class="col-sm-9">
                            {{ Form::text('created_at', date(Config::get('fi.dateFormat')), array('id' => 'copy_created_at', 'class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ trans('fi.group') }}</label>
                        <div class="col-sm-9">
                            {{ Form::select('invoice_group_id', $invoiceGroups, $invoice->invoice_group_id, array('id' => 'copy_invoice_group_id', 'class' => 'form-control')) }}
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('fi.cancel') }}</button>
                <button type="button" id="btn-copy-invoice-submit" class="btn btn-primary">{{ trans('fi.submit') }}</button>
            </div>
        </div>
    </div>
</div>