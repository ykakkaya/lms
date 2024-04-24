@extends('admin.layout.admin_dashboard')
@section('admin_content')



 <div class="page-content">
<h6 class="mb-0 text-uppercase">Alt Kategori Ekle</h6>
						<hr/>

						<div class="card">
							<div class="card-body">
								<form action="{{route('admin.subcategory.store')}}" method="post" enctype="multipart/form-data">
@csrf
									<div class="mb-3">
										<label class="form-label">Alt Kategori Adı</label>
										<input type="text" class="form-control" name="name">
									</div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                        <select class="form-select"  name="category">
                            <option selected>Kategori Seçiniz</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                        </select>
                                    </div>

									<div class="mb-3">
										<label class="form-label">Kategori Resmi:</label>
										<input type="file" class="form-control" id="image" name="image">
									</div>
                                    <div class="mb-3">

                                        <img src="{{ asset('admin/no_image.jpg') }}" id="showImage" class="rounded-circle p-1 bg-primary" width="80"  >

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
