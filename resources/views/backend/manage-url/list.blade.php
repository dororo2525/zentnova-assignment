@extends('layouts.app')

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/skote/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/skote/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/skote/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
        <!-- Sweet Alert-->
        <link href="{{ asset('assets/skote/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap.min.css">
@endsection
@section('content')
<div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Manage Urls</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Url Lists</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Url Lists</h5>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Url</button>
                        </div>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    <script>
                        // Automatically close the alert after 3 seconds
                        setTimeout(function() {
                            $(".alert").alert('close');
                        }, 3000);
                    </script>
                    @elseif($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach                                   
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                            <script>
                                // Automatically close the alert after 3 seconds
                                setTimeout(function() {
                                    $(".alert").alert('close');
                                }, 3000);
                            </script>
                @endif
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                @if(Auth::user()->role == 'admin')
                                <th>User id</th>
                                @endif
                                <th>#</th>
                                <th>Origin Url</th>
                                <th>Shorten Url</th>
                                <th>Code</th>
                                <th>Clicks</th>
                                <th>Status</th>
                                @if(Auth::user()->role == 'admin')
                                <th>User</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $key => $url)
                                <tr>
                                    @if(Auth::user()->role == 'admin')
                                    <td>{{ $url->user_id }}</td>
                                    @endif
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ $url->url }}">{{ $url->origin_url }}</a></td>
                                    <td><a href="{{ request()->root().'/'.$url->code }}">{{ request()->root().'/'.$url->code }}</a></td>
                                    <td>{{ $url->code }}</td>
                                    <td>{{ $url->clicks }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input switch-status" id="customSwitch{{ $url->id }}" data-code="{{ $url->code }}" type="checkbox" role="switch" {{ $url->status == true ? 'checked' : null }}>
                                          </div>
                                    </td>
                                    @if(Auth::user()->role == 'admin')
                                    <td>{{ $url->user->name }}</td>
                                    @endif
                                    <td>
                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                            <li class="list-inline-item px-2">
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"  title="Edit"><i
                                                        class="bx bx-menu bx-sm"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('manage-url.edit' , $url->code) }}" class="dropdown-item btn-edit"  title="Edit"> Edit</a>
                                                            <a href="javascript:void(0);" class="dropdown-item btn-delete" data-code="{{ $url->code }}" title="Delete">Delete</i></a>
                                                        <a href="javascript:void(0);" class="dropdown-item btn-save-qr" data-code="{{ $url->code }}">Save QR Code</a>
                                                        <a class="dropdown-item" href="{{ route('dashboard.show' , $url->code) }}">Report</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                @if(Auth::user()->role == 'admin')
                                <th>User id</th>
                                @endif
                                <th>#</th>
                                <th>Origin Url</th>
                                <th>Shorten Url</th>
                                <th>Code</th>
                                <th>Clicks</th>
                                <th>Status</th>
                                @if(Auth::user()->role == 'admin')
                                <th>User</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
       <!-- Modal -->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-url" action="{{ route('manage-url.store') }}" method="POST">
                        @csrf
                        <div class="{{ Auth::user()->role == 'admin' ? 'mb-3' : null }}">
                            <input type="text" class="form-control" id="url" name="url"
                            placeholder="https://example.com">
                        </div>
                        @if(Auth::user()->role == 'admin')
                        <div class="">
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ Auth::user()->id == $user->user_id ? 'selected' : null }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="btn-save-url" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
 <!-- Required datatable js -->
 <script src="{{ asset('assets/skote/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
 <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <!-- Buttons examples -->
 <script src="{{ asset('assets/skote/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/jszip/jszip.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/pdfmake/build/pdfmake.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/pdfmake/build/vfs_fonts.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

 <!-- Responsive examples -->
 <script src="{{ asset('assets/skote/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('assets/skote/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
 <!-- Sweet Alerts js -->
 <script src="{{ asset('assets/skote/libs/sweetalert2/sweetalert2.min.js') }}"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 
 <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#btn-save-url').click(function() {
                $('#form-url').submit();
            });

            $('.switch-status').click(function() {
                var code = $(this).data('code');
                var status = Number($(this).is(':checked'));
                $.ajax({
                    url: "{{ route('manage-url.switch-status') }}",
                    type: "POST",
                    data: {
                        code: code,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "JSON",
                    success: function(data) {
 
                    }
                });
            });

            $('.btn-delete').click(function(){
                var code = $(this).data('code');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',                    
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('manage-url') }}" + "/" + code,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            dataType: "JSON",
                            success: function(data) {
                                console.log(data);
                                if(data.status == true){
                                    $('#liveToast').addClass('bg-success');
                                    $('.toast-body').text(data.msg);
                                    $('.toast').toast('show');
                                    location.reload();
                                } else{
                                    $('#liveToast').addClass('bg-danger');
                                    $('.toast-body').text(data.msg);
                                    $('.toast').toast('show');
                                }
                            }
                        });
                    }
                });
            });

            $('.btn-save-qr').click(function(){
                var code = $(this).data('code');
            var link = "{{ request()->root().'/' }}" + code;
            var canvas = document.createElement("canvas");
            canvas.width = 800;
            canvas.height = 800;

            var qr = new QRCode( canvas, {
                text: link,
                width: 800,
                height: 800,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            var canvasDraw = qr._oDrawing._elCanvas;

            var dataURL = canvasDraw.toDataURL("image/png");
            var link = document.createElement('a');
            link.download = code + '.png';
            link.href = dataURL;
            link.click();
        })

        });
    </script>
@endsection
