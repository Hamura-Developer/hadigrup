						@extends('layouts.admin')

						@section('title')
							<title> {{ $title }} </title>
							@endsection
						@section('section')
						<div class="">
							<div class="page-title">
							  	<div class="title_left">
									<h3>{{ $title }} <small></small></h3>
								</div>
				
							</div>
				
							<div class="clearfix"></div>
							
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
								  	<div class="x_panel">
									  	<div class="row">
											<div class="x_title">
												<h2>Modul<small></small></h2>
												<ul class="nav navbar-right panel_toolbox">
													<li>
														<a href="{{ url('appweb/modul/create') }}" class="btn btn-primary">
															<i class="fa fa-plus"></i>Tambah
														</a>
													</li>
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="x_content">
												<table class="table table-striped table-bordered" id="listmodul">
												  	<thead>
														<tr>
															<th>No</th>
															<th>Nama Modul</th>
															<th>URL Modul</th>
															<th>Aksi</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endsection
