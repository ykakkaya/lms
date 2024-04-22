@extends('admin.layout.admin_dashboard')
@section('admin_content')



 <div class="page-content">
<h6 class="mb-0 text-uppercase">Kategori Güncelle</h6>
						<hr/>

						<div class="card">
							<div class="card-body">
								<form action="{{route('admin.category.update',$category->id)}}" method="post" enctype="multipart/form-data">
@csrf
									<div class="mb-3">
										<label class="form-label">Kategori Adı</label>
										<input type="text" class="form-control" name="name" value="{{$category->name}}">
									</div>
                                    <div class="mb-3">
                                    </div>

									<div class="mb-3">
										<label class="form-label">Kategori Resmi:</label>
										<input type="file" class="form-control" id="image" name="image">
									</div>
                                    <div class="mb-3">

                                        @empty($category->image)
                                           <img src="{{ asset('admin/no_image.jpg') }}" class="user-img" alt="user avatar" id="showImage">
                                            @else
                                            <img src="{{ asset($category->image) }}" class="user-img" alt="user avatar" id="showImage">
                                           @endempty

                                    </div>
<button type="submit" class="btn btn-primary">Kaydet</button>
								</form>
							</div>
						</div>
                        </div>

                        <script type="text/javascript">

                            $(document).ready(function(){
                                $('#image').change(function(e){
                                    var reader = new FileReader();
                                    reader.onload = function(e){
                                        $('#showImage').attr('src',e.target.result);
                                    }
                                    reader.readAsDataURL(e.target.files['0']);
                                });
                            });

                        </script>
@endsection
