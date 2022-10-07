<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @if (session('success'))
                        <span class="alert alert-primary" role="alert">{{ session('success') }}</span>
                    @elseif(session('failed'))
                    <span class="alert alert-danger" role="alert">{{ session('failed') }}</span>
                    @else
                    
                    @endif
                </div>
                <button type="" class=" btn btn-primary mt-2 ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Contact</button>
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Active Customers</button>
                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Blacklisted Customers</button>
                          {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table id="" class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Number</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($user as $item)
                                   @if ($item->status == 1)
                                       <tr>
                                        <td>{{ $item->fname }}</td>
                                        <td>{{ $item->lname }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>@if ($item->status == 1)
                                            Whitelist
                                            @else
                                            Blacklist 
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-3"><button class=" btn btn-secondary btn-sm" id="btnEdit" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></div>
                                            <div class="col-md-3"><button class=" btn btn-danger btn-sm" id="btnDel" data-id="{{ $item->id }}">Delete</button></div>
                                            <div class="col-md-3">
                                                @if ($item->status == 1)
                                                    <button class=" btn btn-danger btn-sm" id="btnBlacklist" data-id="{{ $item->id }}">Blacklist</button>
                                                @endif      
                                            </div>
                                        </div>
                                    </td>
                                       </tr>
                                   @endif
                                       
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <table id="" class="table table-bordered table-striped example1">
                                <thead>
                                    <tr>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Number</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($user as $item)
                                   @if ($item->status == 0)
                                       <tr>
                                        <td>{{ $item->fname }}</td>
                                        <td>{{ $item->lname }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>@if ($item->status == 1)
                                            Whitelist
                                            @else
                                            Blacklist 
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-3"><button class=" btn btn-secondary btn-sm" id="btnEdit" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button></div>
                                            <div class="col-md-3"><button class=" btn btn-danger btn-sm" id="btnDel" data-id="{{ $item->id }}">Delete</button></div>
                                            <div class="col-md-3">
                                                @if ($item->status == 0)
                                                    <button class=" btn btn-danger btn-sm" id="btnBlacklist" data-id="{{ $item->id }}">Whitelist</button>
                                                @endif      
                                            </div>
                                        </div>
                                    </td>
                                       </tr>
                                   @endif
                                       
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            
                        </div> --}}
                      </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ url('save-user') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">First Name</label>
                        <input type="text" name="fname" id="" class=" form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" id="" class=" form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone No.</label>
                        <input type="number" name="phone" id="" class=" form-control" required>
                    </div>
                </div>
                
            <button type="" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Close</button>
              <button type="" class="btn btn-primary mt-3">Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Customer Info</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">First Name</label>
                        <input type="text" name="fname" id="fname" class=" form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" id="lname" class=" form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Phone No.</label>
                        <input type="number" name="phone" id="phone" class=" form-control" required>
                    </div>
                </div>
                
            <button type="" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Close</button>
              <button type="" class="btn btn-primary mt-3">Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>
