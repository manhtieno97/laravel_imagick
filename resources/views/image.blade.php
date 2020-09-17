@extends(backpack_view('blank'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif
                @if (Session::has('error'))
                    <p class="alert alert-danger">{{Session::get('error')}}</p>
                @endif
                <div class="card">
                    <div class="card-header">
                        Imagick
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/admin/post-image" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="">List ảnh</label>
                                    </div>
                                    <input required  id="img" type="file" class=" d-none" name="images[]"  multiple onchange="changeImg(this)">
                                    <img id="avatar" class="img-thumbnail" width="200px" src="{{url('img')}}/no-ig.png">
                                    <div class="row" id="list-img">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Ghép</button>
                                </form>
                            </div>
                            <div class=" col-md-12 image-new @if(!empty($name)) d-block  @else d-none  @endif ">
                                <img id="avatar-new" class="img-thumbnail" width="500px" @if(!empty($name)) src="{{ url('storage/images/').'/'.$name }}"  @else src="{{url('img')}}/no-ig.png"   @endif  >
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('after_styles')

@endsection

@section('after_scripts')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#avatar').click(function(){
                $('#img').click();
            });
        });
        function changeImg(input){
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if(input.files ){
                var fileList = input.files;
                for (let i = 0, numFiles = fileList.length; i < numFiles; i++) {
                    const file = fileList[i];
                    var reader = new FileReader();
                    var img_1 = '';
                    //Sự kiện file đã được load vào website
                    reader.onload = function(e){
                        //Thay đổi đường dẫn ảnh
                        //$('#avatar').attr('src',e.target.result);
                        img_1 += '<div class="col-md-3"><a class="thumbnail multi-select"><img width="100%" src="'+e.target.result+'" alt=""></a></div>';
                        $('#list-img').html(img_1);
                    }
                    reader.readAsDataURL(file);
                    // ...
                }


            }
        }
    </script>
@endsection
