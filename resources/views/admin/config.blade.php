@extends('admin.layouts.master')
@section('css')
	<style>
	</style>
@endsection
@section('content')
<section class="content">
    <header class="content__title">
        <h1>Configurations</h1>       
    </header>
    <div class="card">
        <div class="card-body">           
			<?php 
			$data = App\Models\m_flag::where('is_config', 1)->get();
			?>
			@if($data)
				<form  enctype="multipart/form-data" class="row" method="POST"  action="{{route('admin.configSave')}}" >
					@csrf
					@foreach($data as $items)
						<div class="col-md-6">
							<div class="form-group">
								<label class="" for="form-field-6">
									@if($items->flag_show_text=="")
										{{$items->flag_type}}
									@else
										{{$items->flag_show_text}}
									@endif
								</label>
								<input type="text" class="form-control" value="{{$items->flag_value==$items->flag_additionalText?$items->flag_value:$items->flag_additionalText}}" name="{{$items->flag_type}}" />
								<i class="form-group__bar"></i>
							</div>
						</div>
					@endforeach
					<div class="col-md-12">
						<div class="form-group">
							<input type="submit" class="btn btn-outline-success float-right" value="Update" />
						</div>
					</div>
				</form>
			@endif
		</div>
	</div>    
</section>

@endsection

@section('js')
		
@endsection