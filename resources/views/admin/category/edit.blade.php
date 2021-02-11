<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category  <b> </b> 
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">           
                    
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Edit category</div>
                    <div class="card-body">
                    <form action="{{ url('category/update/'.$categories->id) }}" method="POST">
                        @csrf                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Update category name </label>
                          <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $categories->category_name }}"> {{-- value use to show category name which will edit --}}
                          @error('category_name')
                           <span class="text-danger"> {{ $message }}</span>   {{-- display all validation --}}
                          @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update category</button>
                      </form>
                  </div>
                </div>
            </div>


          </div>
        </div>
    </div>
</x-app-layout>
