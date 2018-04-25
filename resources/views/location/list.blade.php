@extends('master')

@section('content')

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Locations</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Location</a></li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="button-group">
                            {!! Form::open(['url' => 'location', 'method' => 'POST', 'class' => 'form-horizontal', 'id'=>"locationForm" ]) !!}
                            <div class="form-body">
                                <hr class="m-t-0 m-b-40">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="col-md-9">
                                                {!! Form::text('location',NULL,['class' => 'form-control','placeholder' => 'Enter Location','id' => 'location']) !!}
                                                <small class="form-control-feedback"> eg Durban  </small>

                                                {!! Form::hidden('gps',NULL) !!}


                                            </div>
                                        </div>
                                        @if(Session::has('message'))
                                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        @if(Session::has('message'))
                                            <p class="alert alert-danger">{{ Session::get('message') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="table-responsive m-t-40">
                            <table id="locations" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>GPS Lat</th>
                                    <th>GPS Lon</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>


                                @forelse($venues as $venue)

                                    <tr>

                                        <td>{{ $venue->id }}</td>
                                        <td>{{ $venue->name }}</td>
                                        <td>{{ $venue->lat }}</td>
                                        <td>{{ $venue->lon }}</td>
                                        <td><a href="{{ URL::to('images/' . $venue->location->name .'/'.$venue->id ) }}" class="btn btn-success">View Images</a></td>


                                    </tr>

                                @empty

                                    <p>There are no relevant results at this time .</p>

                                @endforelse



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection

@section('footer')

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script>


        $(document).ready(function(){

            if ( $.fn.dataTable.isDataTable( '#locations' ) ) {
                oTableLocation.destroy();
            }

            oTableLocation  = $('#locations').DataTable({})


        })
    </script>

@endsection
