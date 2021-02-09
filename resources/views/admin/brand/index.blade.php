<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand  <b> </b> 
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="card">

                     @if(session('success'))    {{--if in session variabe have any success id (message) when will be displayed this message --}}
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong> {{--display success session variable --}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @endif
                        <div class="card-header"> All Brand</div>
                      
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Brand name</th>
                        <th scope="col">Brand Image </th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    {{-- @php($i = 1) --}}

                    @foreach($brands as $brand)
                      <tr>
                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th> {{-- we use $brands->firstItem()+$loop->index, for reason, that numering will countinous in every next page  // brands is plural--}}
                        <td>{{ $brand->brand_name }}</td>
                        <td><img src="" alt="" ></td>  {{--  because is one to one relation we use user method created in category model to access user name --}}
                   {{--  <td>{{ $category->name }}</td>   when we use querybuider we don't need user method from category model, and we access name straight --}}
                        <td>
                          @if($brand->created_at == NULL) {{-- without if we get error because we use diffForHumans --}}
                          <span class="text-danger">No Date Set</span>
                          @else
                          {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                          @endif
                        </td> 
                        <td>
                         <a href="{{ url('brand/edit/'.$brand->id) }}"class="btn btn-info">Edit</a>{{-- edit fied by specific field --}}
                        <a href="{{ url('softdelete/brand/'.$brand->id) }}"class="btn btn-danger">Delete</a>
                        </td>

                    </tr> 
                    @endforeach                 
                    </tbody>
                  </table> 
                   {{ $brands->links() }} {{-- with links() we add all pagination // brands is plural--}}
                  
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Add brand</div>
                    <div class="card-body">
                    <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Brand Name</label>
                          <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('brand_name')
                           <span class="text-danger"> {{ $message }}</span>   {{-- display all validation --}}
                          @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Image</label>
                            <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('brand_image')
                             <span class="text-danger"> {{ $message }}</span>   {{-- display all validation --}}
                            @enderror
                          </div>
                        
                        <button type="submit" class="btn btn-primary">Add Brand</button>
                      </form>
                  </div>
                </div>
            </div>


          </div>
        </div>

    </div>
</x-app-layout>
