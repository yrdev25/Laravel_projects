<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        jQuery FineCrop Plugin Example
    </title>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js" integrity="sha512-4WpSQe8XU6Djt8IPJMGD9Xx9KuYsVCEeitZfMhPi8xdYlVA5hzRitm0Nt1g2AZFS136s29Nq4E4NVvouVAVrBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ asset('css/fineCrop.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
    <script src="{{ asset('js/fineCrop.js') }}"></script>

</head>

<body>
    <div class="container">
        <a class="btn btn-info" style="margin : 20px 0px 0px 0px" href="{{ route('create') }}">See Users</a>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>Image Upload</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            Name:
                            <input type="text" name="name" id="name" />
                        </div>
                        <div class="card-text" style="margin : 10px 0px 0px 0px">
                            Email:
                            <input type="text" name="email" id="email" />
                        </div>

                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                        <input type="file" id="upphoto" style="display:none;">

                        <label for="upphoto">
                            <div class="inputLabel">
                                Upload Image
                            </div>
                        </label>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <img id="croppedImg" style="border:5px solid #000; margin:auto;">
            </div>
        </div>
    </div>
   <div>
    </div>
                    </div>
                </div>
                <div style="margin : 0px 0px 0px 110px">
                <a class='btn btn-warning' id='buttonid'>Submit</a>
                </div>

               

<!--
    Div structure : Manitan a container which has class "cropHolder"
                    Inside this, another div with the ID of "cropWrapper" and inside this use <img> with any id
                    this have to use in this option: (cropInput: 'inputImage')
    CropInputs    : Here you can maintain structure as you want but keep these IDs same
                    1. "xmove" : for horizontal moving
                    2. "ymove" : for vertical moving
                    3. "zplus" : zoom in button
                    4. "zminus": zoom out button
                    5. "cropSubmit" : submitting the crop
                    6. "closeCrop" : closing the cropping screen
 -->
    <div class="cropHolder">
        <div id="cropWrapper">
            <img id="inputImage" src="{{ asset('images/face.jpg') }}">
        </div>
        <div class="cropInputs">
            <div class="inputtools">
                <p>
                    <span>
                        <img src="{{ asset('images/horizontal.png') }}">
                    </span>
                    <span>horizontal movement</span>
                </p>
                <input type="range" class="cropRange" name="xmove" id="xmove" min="0" value="0">
            </div>
            <div class="inputtools">
                <p>
                    <span>
                        <img src="{{ asset('images/vertical.png') }}">
                    </span>
                    <span>vertical movement</span>
                </p>
                <input type="range" class="cropRange" name="ymove" id="ymove" min="0" value="0">
            </div>
            <br>
            <button class="cropButtons" id="zplus">
                <img src="{{ asset('images/add.png') }}">
            </button>
            <button class="cropButtons" id="zminus">
                <img src="{{ asset('images/minus.png') }}">
            </button>
            <br>
            <button id="cropSubmit">submit</button>
            <button id="closeCrop">Close</button>
        </div>
    </div>
    <script>
       
        $("#upphoto").finecrop({
            viewHeight: 500,
            cropWidth: 200,
            cropHeight: 200,
            cropInput: 'inputImage',
            cropOutput: 'croppedImg',
            zoomValue: 50
        });

        $('#buttonid').click(function(){
               let base = $('#croppedImg').attr('src');
               //console.log(base);

               let token = $('#token').val();
               let name = $('#name').val();
               let email = $('#email').val();
                     $.ajax({
                        url : '{{ route('store') }}',
                        type : 'post',
                        data : { name : name, email : email, _token : token , image : base},
                        success : function(data){
                            window.location.href = "{{ route('create') }}";
                        }
                     });
        });

      
    </script>
</body>


</html>
