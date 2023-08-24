@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container-fluid">
      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">EDIT URL</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">DASHBOARD</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('manage-url.index') }}">MANAGE URLS</a></li>
                        <li class="breadcrumb-item active">EDIT URL</li>
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
                        <h5 class="mb-0 card-title flex-grow-1">EDIT URL</h5>
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
                    <form class="outer-repeater" action="{{ route('manage-url.update' , $result->code) }}"  method="POST">
                        @csrf
                        @method('PUT')
                          <div data-repeater-list="outer-group" class="outer">
                              <div data-repeater-item class="outer">
                                  <div class="form-group row mb-4">
                                      <label for="code" class="col-form-label col-lg-2">Code</label>
                                      <div class="col-lg-10">
                                          <input id="code" name="code" type="text" class="form-control" value="{{ old('code' , $result->code) }}" placeholder="Enter Code..." disabled>
                                      </div>
                                  </div>
                                  <div class="form-group row mb-4">
                                      <label for="url" class="col-form-label col-lg-2">Url</label>
                                      <div class="col-lg-10">
                                          <input id="url" name="url" type="text" class="form-control" value="{{ old('origin_url' , $result->origin_url) }}" placeholder="Enter Origin Url...">
                                      </div>
                                  </div>
                                  <div class="form-group row mb-4">
                                    <label for="flexSwitchCheckDefault" class="col-form-label col-lg-2">Status</label>
                                    <div class="col-lg-10">
                                        <div class="form-check form-switch form-switch-md mb-3">
                                            <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" {{ $result->status == true ? 'checked' : null }}>
                                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                        </div>
                                          </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary">Update Url</button>
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
@endsection

@section('js')

@endsection