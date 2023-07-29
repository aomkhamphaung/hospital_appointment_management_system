<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
        }
    </style>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      {{-- <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- sidebar --}}
      @include('admin.sidebar')

      <!-- partial -->
        {{-- navbar --}}
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            <div align="center" style="padding: 50px;">
                <table>
                    <thead>
                        <tr style="background-color: black;">
                            <th style="padding: 10px">Customer Name</th>
                            <th style="padding: 10px">Email</th>
                            <th style="padding: 10px">Phone</th>
                            <th style="padding: 10px">Doctor Name</th>
                            <th style="padding: 10px">Date</th>
                            <th style="padding: 10px">Message</th>
                            <th style="padding: 10px">Status</th>
                            <th style="padding: 10px">Approved</th>
                            <th style="padding: 10px">Canceled</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td style="padding: 10px;">{{$data->name}}</td>
                                <td style="padding: 10px;">{{$data->email}}</td>
                                <td style="padding: 10px;">{{$data->phone}}</td>
                                <td style="padding: 10px;">{{$data->doctor}}</td>
                                <td style="padding: 10px;">{{$data->date}}</td>
                                <td style="padding: 10px;">{{$data->message}}</td>
                                <td style="padding: 10px;">{{$data->status}}</td>
                                <td style="padding: 10px;"><a href="{{route('approved', $data->id)}}" class="btn btn-success">Approve</a></td>
                                <td style="padding: 10px;"><a href="{{route('canceled', $data->id)}}" class="btn btn-danger">Cancel</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>