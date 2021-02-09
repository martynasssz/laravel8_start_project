<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category  <b> </b> 
           
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
                        <div class="card-header"> All category</div>
                      
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Username </th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    {{-- @php($i = 1) --}}

                    @foreach($categories as $category)
                      <tr>
                        <th scope="row">{{ $categories->firstItem()+$loop->index }}</th> {{-- we use $categories->firstItem()+$loop->index, for reason, that numering will countinous in every next page--}}
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->user->name }}</td>  {{--  because is one to one relation we use user method created in category model to access user name --}}
                   {{--  <td>{{ $category->name }}</td>   when we use querybuider we don't need user method from category model, and we access name straight --}}
                        <td>
                          @if($category->created_at == NULL) {{-- without if we get error because we use diffForHumans --}}
                          <span class="text-danger">No Date Set</span>
                          @else
                          {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                          @endif
                        </td> 
                        <td>
                         <a href="{{ url('category/edit/'.$category->id) }}"class="btn btn-info">Edit</a>{{-- edit fied by specific field --}}
                        <a href="{{ url('softdelete/category/'.$category->id) }}"class="btn btn-danger">Delete</a>
                        </td>

                    </tr> 
                    @endforeach                 
                    </tbody>
                  </table> 
                   {{ $categories->links() }} {{-- with links() we add all pagination --}}
                  
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"> Add category</div>
                    <div class="card-body">
                    <form action="{{ route('store.category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Category Name</label>
                          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('category_name')
                           <span class="text-danger"> {{ $message }}</span>   {{-- display all validation --}}
                          @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Add category</button>
                      </form>
                  </div>
                </div>
            </div>


          </div>
        </div>

   {{-- Trash part                --}}

  <div class="container">
      <div class="row">

          <div class="col-md-8">
              <div class="card">
              
              <div class="card-header"> Trash list</div>
                
          <table class="table">
              <thead>
                <tr>
                  <th scope="col">SL No</th>
                  <th scope="col">Category name</th>
                  <th scope="col">Username </th>
                  <th scope="col">Created at</th>
                  <th scope="col">Action</th>

                </tr>
              </thead>
              <tbody>
              {{-- @php($i = 1) --}}

              @foreach($trashCat as $category)
                <tr>
                  <th scope="row">{{ $categories->firstItem()+$loop->index }}</th> {{-- we use $categories->firstItem()+$loop->index, for reason, that numering will countinous in every next page--}}
                  <td>{{ $category->category_name }}</td>
                  <td>{{ $category->user->name }}</td>  {{--  because is one to one relation we use user method created in category model to access user name --}}
             {{--  <td>{{ $category->name }}</td>   when we use querybuider we don't need user method from category model, and we access name straight --}}
                  <td>
                    @if($category->created_at == NULL) {{-- without if we get error because we use diffForHumans --}}
                    <span class="text-danger">No Date Set</span>
                    @else
                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                    @endif
                  </td> 
                  <td>
                   <a href="{{ url('category/restore/'.$category->id) }}"class="btn btn-info">Restore</a>{{-- edit fied by specific field --}}
                  <a href="{{ url('pdelete/category/'.$category->id) }}"class="btn btn-danger">P Delete</a> {{-- permanent delete --}}
                  </td>

              </tr> 
              @endforeach                 
              </tbody>
            </table> 
             {{ $trashCat->links() }} {{-- with links() we add all pagination --}}
            
          </div>
      </div>

      <div class="col-md-4">
          
      </div>


    </div>
  </div>

  {{-- End Trash --}}
    </div>
</x-app-layout>
