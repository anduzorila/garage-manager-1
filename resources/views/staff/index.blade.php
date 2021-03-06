@extends('layouts.master')

@section('title', 'List of repairs')

@section('content-header')
<h1>
  List of staff members
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Staff</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><strong><a href="{{ URL::route('staff.create') }}" class="btn btn-success" data-toggle="modal" data-target="#Modal">Create</a></strong></h3>
      </div><!-- /.box-header -->

		<!-- Modal -->
		<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel">
		  <div class="modal-dialog" role="document"><div class="modal-content"></div>
		  </div>
		</div><!-- modal -->
      <div class="box-body">
        <table id="main-table" class="table table-bordered table-hover">
          <thead>
            <tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone Number</th>
				<th>E-mail address</th>
				<th>Edit</th>
				<th>Delete</th>
            </tr>
          </thead>
          <tbody>
		    @for ($i = 0; $i < $count; $i++)
			<tr>
				<td><a href="{{ URL::route('staff.show', array($staff[$i]['Id'])) }}">{{ $staff[$i]['Id'] }}</a></td>
				<td><a href="{{ URL::route('staff.show', array($staff[$i]['Id'])) }}">{{ $staff[$i]['Name'] }}</a></td>
				<td>{{$staff[$i]['Address']}}</td>
				<td>{{$staff[$i]['PhoneNo']}}</td>
				<td>{{$staff[$i]['Email']}}</td>

				<td><a href="{{ URL::route('staff.edit', array($staff[$i]['Id'])) }}" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$staff[$i]['Id']}}">Edit</a></td>

				<div class="modal fade" id="Modal{{$staff[$i]['Id']}}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel">
				  <div class="modal-dialog" role="document"><div class="modal-content"></div>
				  </div>
				</div><!-- modal -->

				<td>{!! Form::open(['route' => ['staff.destroy', $staff[$i]['Id']], 'method' => 'DELETE']) !!}
					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
				<!--a href="{{ URL::route('staff.destroy', array($staff[$i]['Id'])) }}">Delete</a-->
				{!! Form::close() !!}</td>
			</tr>

			@endfor
          </tbody>
          <tfoot>
            <tr>
				<th>ID</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone Number</th>
				<th>E-mail address</th>
				<th>Edit</th>
				<th>Delete</th>
            </tr>
          </tfoot>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('table-id', 'main-table')
