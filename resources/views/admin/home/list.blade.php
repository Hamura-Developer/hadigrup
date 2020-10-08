@extends('layouts.admin')

@section('title')
	<title> {{ $title }} </title>
@endsection

@section('section')
	<div class="row tile_count">
		<div class="col-lg-3 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Total Artikel</span>
			<div class="count" data-counter="counterup" data-value="{{
				$totalartikel }}"> 0
			</div>
		</div>
		<div class="col-lg-3 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
			<span class="count_top"><i class="fa fa-clock-o"></i> Total Halaman</span>
			<div class="count" data-counter="counterup" data-value="{{
				$totalpage }}"> 0
			</div>
		</div>
		<div class="col-lg-3 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Total Partner</span>
			<div class="count green" data-counter="counterup" data-value="{{
				$totalpartner }}">0
			</div>
		</div>
		<div class="col-lg-3 col-md-2 col-sm-4 col-xs-4 tile_stats_count">
			<span class="count_top"><i class="fa fa-user"></i> Total Pekerjaan</span>
			<div class="count green" data-counter="counterup" data-value=""> 0
			</div>
		</div>
	</div>
	<div class="container">	
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-dark bold uppercase">
							<i class="icon-basket-loaded"></i> TOP PEKERJAAN</span>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="remove">
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-dark bold uppercase">
							<i class="icon-basket-loaded"></i> Blog</span>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="remove">
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tabbable-line">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#mostviewedblog" data-toggle="tab">
									Most Viewed </a>
								</li>
								<li>
									<a href="#lastpostblog" data-toggle="tab">
									Last Post </a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="mostviewedblog">
									<div class="table-responsive">
										<table class="table table-striped table-hover table-bordered">
											<thead>
												<tr>
													<th>
														Judul
													</th>
													<th>
														Kategori
													</th>
													<th>
														Dilihat
													</th>
													<th>
														Aksi
													</th>
												</tr>
											</thead>
											<tbody>
												@foreach($topviewblog as $data)
													<tr>
														<td width="45%">
															<a href="javascript:;"> 
															{{ $data->judul }}</a>
														</td>
														<td  width="25%">
															{{ $data->kategori }}
														</td>
														<td  width="15%">
															{{ $data->hits }} &nbsp;<i class="fa fa-eye"></i>
														</td>
														<td width="15%">
															<a href="{{ url('blog/'.Str::slug($data->kategori).'/'.$data->slug) }}" target="_blank" class="btn btn-sm btn-default">
															<i class="fa fa-search"></i> View </a>
														</td>
													</tr>
												@endforeach	 
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="lastpostblog">
									<div class="table-responsive">
										<table class="table table-striped table-hover table-bordered">
											<thead>
												<tr>
													<th>
														Judul
													</th>
													<th>
														Kategori
													</th>
													<th>
														Dilihat
													</th>
													<th>
														Aksi
													</th>
												</tr>
											</thead>
											<tbody>
												
												@foreach($lastpostblog as $data) 
												<tr>
													<td width="45%">
														<a href="javascript:;"> 
														{{ $data->judul }}</a>
													</td>
													<td  width="25%">
														{{ $data->kategori }}
													</td>
													<td  width="15%">
														{{ $data->hits }} &nbsp;<i class="fa fa-eye"></i>
													</td>
													<td width="15%">
														<a href="{{ url('blog/'.Str::slug($data->kategori).'/'.$data->slug) }}" target="_blank" class="btn btn-sm btn-default">
														<i class="fa fa-search"></i> View </a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection