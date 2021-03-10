@if (session()->has('status_danger'))
	<div class="col-md-12 order-md-1">
		<div class="row">
			<div class="col-md-12  ">
                <div class="alert alert-danger text-sm-center">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h6>{{ session('status_danger') }}</h6>
                </div>
        	</div>
        </div>
    </div>
    @endif
    
    @if (session()->has('success'))
	<div class="col-md-12 order-md-1">
		<div class="row">
			<div class="col-md-12  ">
                <div class="alert alert-success text-sm-center">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h6>{{ session('success') }}</h6>
                </div>
        	</div>
        </div>
    </div>
@endif