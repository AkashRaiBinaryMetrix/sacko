@extends('admin.layouts.app')
@section('content')
<!-- [ Layout content ] Start -->
<div class="layout-content">
<!-- [ content ] Start -->
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-0">@lang('message.create_incentive')</h4>
    <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.incentive.index') }}">@lang('message.incentive')</a></li>
            <li class="breadcrumb-item active">@lang('message.create_incentive')</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if(Session::has('message'))  
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-ok "><strong>Success!</strong></span><em> {!! session('message') !!}</em>
            </div>
            @endif
			@foreach ($errors->all() as $error)
			<div class=" alert alert-danger alert-dismissible">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<span class="glyphicon glyphicon-remove"></span>{{ $error }}
			</div>
			@endforeach
        </div>
    </div>
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account-general">
                    	<form role="form" action="{{ url('admin/incentive/store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"> 
                        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<h6 class="card-header">@lang('message.incentive_details')</Details></h6>
                       		<div class="card-body">
								
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.team_leader')<span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="user_id" required >                       
                                            <option value="">Select</option>
                                            @if($employees->count())
                                                @foreach($employees as $emp)
                                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
										@if($errors->has('user_id'))
                                        <div class="text-danger">{{ $errors->first('user_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.product')<span class="text-danger">*</span></label>
										<select class="form-control select2 select2-hidden-accessible" name="product_id" required >                       
                                            <option value="">Select</option>
                                            @if($products->count())
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
										@if($errors->has('product_id'))
                                        <div class="text-danger">{{ $errors->first('product_id') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.incentive')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="gift" placeholder="Enter Incentive" required value="{{old('gift')}}">
                                        @if($errors->has('gift'))
                                        <div class="text-danger">{{ $errors->first('gift') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
									<div class="form-group col-md-6">
										<label class="form-label">@lang('message.quantity')<span class="text-danger">*</span></label>
										<input type="text"  class="form-control" name="quantity" placeholder="Enter Quantity" required value="{{old('quantity')}}">
                                        @if($errors->has('quantity'))
                                        <div class="text-danger">{{ $errors->first('quantity') }}</div>
                                        @endif
										<div class="clearfix"></div>
									</div>
								</div>
								
									<div class="text-right mt-3">
										<button type="submit" class="btn btn-primary">Save </button>&nbsp;
										<a href="{{route('admin.incentive.index');}}"  class="btn btn-default">Cancel</a>
									</div>
								</div>
                        	</div>
                     	</form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- [ content ] End -->
@endsection