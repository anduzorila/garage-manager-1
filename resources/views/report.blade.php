@extends('layouts.master')

@section('title', $title)

@section('content-header')
<h1>{{ $title }}</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Reports</a></li>
  <li class="active">{{ $title }}</li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><strong>{{ $title }}</strong></h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="main-table" class="table table-bordered table-hover">
          <thead>
            <tr>
				<th>ID</th>
				<th>Plate Number</th>
				<th>Model</th>
				<th>Client</th>
				<th>Type</th>
				<th>Comments</th>
				<th>Staff in charge</th>
				<th>Start Date</th>
				<th>Expected End Date</th>
				<th>Ongoing?</th>
				<th>Cost</th>
				<th>Paid?</th>
				<th>Edit</th>
				@if (Auth::user()->isAdmin)
					<th>Delete</th>
				@endif
            </tr>
          </thead>
          <tbody>
		    @foreach ($repairs as $repair)
		    <tr>
		      <td>{{$repair['Id']}}</td>
		      <td><a href="{{ URL::route('cars.show', array($repair['LicencePlate'])) }}">{{ $repair['LicencePlate'] }}</a></td>
		      <td>{{ $repair->car->Model }}</td>
		      <td><a href="{{ URL::route('clients.show', array($repair->car->ClientId)) }}">{{ $repair->car->owner->Name . ' [' . $repair->car->owner->Id . ']' }}</a></td>
		      <td>{{ $repair['Type'] }}</td>
		      <td>{{ $repair['Comments'] }}</td>
		      @if (Auth::user()->isAdmin && $repair->staff->deleted_at === null)
		        <td><a href="{{ URL::route('staff.show', array($repair['StaffId'])) }}">{{ $repair->staff->Name . ' [' . $repair['StaffId'] . ']'  }}</a></td>
		      @else
		        <td>{{ $repair->staff->Name . ' [' . $repair['StaffId'] . ']' }}</td>
		      @endif
		      <td>{{ $repair['StartDate']->format("j M Y") }}</td>
		      <td>{{ $repair['EndDate']->format("j M Y") }}</td>
		      <td>{{ $repair['Ongoing'] ? 'Yes' : 'No' }}</td>
		      <td>{{ '£' . $repair['Cost'] }}</td>
		      <td>{{ $repair['Paid'] ? 'Yes' : 'No' }}</td>

		      <td><a href="{{ URL::route('repairs.edit', array($repair['Id'])) }}" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$repair['Id']}}">Edit</a></td>

				<div class="modal fade" id="Modal{{$repair['Id']}}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel">
				  <div class="modal-dialog" role="document"><div class="modal-content"></div>
				  </div>
				</div><!-- modal -->

		      @if (Auth::user()->isAdmin)
		        <td>{!! Form::open(['route' => ['repairs.destroy', $repair['Id']], 'method' => 'DELETE']) !!}
		          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		          {!! Form::close() !!}</td>
		      @endif
		    </tr>
		    @endforeach
          </tbody>
          <tfoot>
            <tr>
				<th>ID</th>
				<th>Plate Number</th>
				<th>Model</th>
				<th>Client</th>
				<th>Type</th>
				<th>Comments</th>
				<th>Staff in charge</th>
				<th>Start Date</th>
				<th>Expected End Date</th>
				<th>Ongoing?</th>
				<th>Cost</th>
				<th>Paid?</th>
				<th>Edit</th>
				@if (Auth::user()->isAdmin)
					<th>Delete</th>
				@endif
            </tr>
          </tfoot>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('table-id', 'main-table')