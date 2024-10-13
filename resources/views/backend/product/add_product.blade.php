@extends('layouts.admin')

@section('content')
@can('product_access')


  <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Product</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                  <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                             <label for="" class="form-label">Category</label>
                             <select name="category_id" class="form-control category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                   <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                             <label for="" class="form-label">Sub Category</label>
                             <select name="subcategory_id" class="form-control" id="sub">
                                <option value="">Select Sub Category</option>
                                @foreach ($subcategories as $subcategory)
                                   <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name}}</option>
                                @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                             <label for="" class="form-label">Brand</label>
                             <select name="brand_id" class="form-control" >
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                   <option value="{{ $brand->id }}">{{ $brand->brand_name}}</option>
                                @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                             <label for="" class="form-label">Product Name</label>
                             <input type="text" class="form-control" name="product_name">
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="mb-3">
                             <label for="" class="form-label">Product Discount</label>
                             <input type="number" class="form-control" name="discount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                             <label for="" class="form-label">Short Description</label>
                             <input type="text" class="form-control" name="short_desp">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                             <label for="" class="form-label">Long Description</label>
                             <textarea name="long_desp" id="summernote" cols="30" rows="8" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                             <label for="" class="form-label">Additional Information</label>
                             <textarea name="additional_info" id="summernote1" cols="30" rows="8" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                             <label for="" class="form-label">Tags</label>
                             <select id="select-gear" name="tag_id[]" class="demo-default" multiple placeholder="Select gear...">
                                <option value="">Select gear...</option>
                                <optgroup label="Climbing">
                                    @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </optgroup>
                              </select>

                        </div>
                    </div>
             <!-- <div class="col-lg-6">
                        <div class="mb-3">
                             <label for="" class="form-label">Preview Image</label>
                             <input type="file" name="preview" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                             <div class="my-2">
                                <img src="" id="blah" alt="" width="200">
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"> <p>Drag and drop a file here or click</p></span><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" id="myDropify" class="border" name="preview"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                             <label for="" class="form-label">Thumbnails</label>
                             <input type="file" name="thumbnails[]" class="form-control" multiple onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                             <div class="my-2">
                                <img src="" id="blah1" alt="" width="200">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 m-auto">
                        <div class="mb-3 mt-5">
                             <button type="submit" class="btn btn-primary form-control">Add Product</button>
                        </div>
                    </div>
                  </div>
               </form>
            </div>
        </div>
    </div>
  </div>
  @endcan
@endsection

@section('footer_script')
<script>
 $('.category').change(function(){
    var category_id = $(this).val();
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
        type:'POST',
        url:'/getsubcategory',
        data:{'category_id':category_id},
        success:function(data){
            $('#sub').html(data);
       //     $('#subcategory_id').html(data);
        }

    });
 })
</script>
<script>
    $('#select-gear').selectize({ sortField: 'text' })

    $('#summernote').summernote();
    $('#summernote1').summernote();
</script>
@endsection
