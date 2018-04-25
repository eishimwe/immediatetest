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
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Location</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ $location  }}</a></li>
                    <li class="breadcrumb-item active">images</li>
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

                        <div class="table-responsive m-t-40">
                            <table id="locations" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>


                                </tr>
                                </thead>

                                <tbody>


                                @forelse($images as $image)

                                    <tr>

                                        <td>
                                            <img src="https://farm{{ $image->image_farm }}.staticflickr.com/{{ $image->image_server }}/{{ $image->image_id }}_{{ $image->image_secret }}.jpg"/>

                                        </td>

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


        $('#searchLocation').on('click',function(){

            var location = $('#location').val();

            $.ajax({
                type:'GET',

                data: {'near': location},
                url: 'https://api.foursquare.com/v2/venues/explore?client_id=BMN3JTXL3ZXIN2EMAZSFSVFQMLXGA2J5EL2BTNWNNS3WFRUD&client_secret=NA5NOCBCX4FYCVDTW054I0RD3VKDTJ3DYYHPVKNYNMLXBIJG&v=20180323',
                success: function(data){

                    if(data.response){

                        if(data.response.groups){

                            if(data.response.groups[0].items.length > 0){


                                $.ajax({

                                    type:'POST',
                                    dataType:'json',
                                    data:{'location': location},
                                    url: "{!! url('venues')!!}",
                                    success: function(data){




                                    }



                                })



                            }
                        }

                    }

                }
            });


        })



        $(document).ready(function(){

            if ( $.fn.dataTable.isDataTable( '#locations' ) ) {
                oTableLocation.destroy();
            }

            oTableLocation  = $('#locations').DataTable({})


        })






    </script>

@endsection
