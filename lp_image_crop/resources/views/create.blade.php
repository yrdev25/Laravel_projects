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

    <link href={{ asset('css/fineCrop.css') }} rel="stylesheet" />
    <link href={{ asset('css/layout.css') }} rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
    <script src={{ asset('js/fineCrop.js') }}></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1>jQuery FineCrop Plugin Example</h1>
<div class="jquery-script-ads">
    <script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-lg-8 col-md-7 col-sm-6"> --}}
                <input type="file" id="upphoto" style="display:none;">
                <label for="upphoto">
                    <div class="inputLabel">
                        click here to upload an image
                    </div>
                </label>

    
            {{-- </div> --}}
        </div>

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
            <img id="inputImage" src={{ asset('images/face.jpg') }}>
        </div>
        <div class="cropInputs">
            <div class="inputtools">
                <p>
                    <span>
                        <img src={{ asset('images/horizontal.png') }}>
                    </span>
                    <span>horizontal movement</span>
                </p>
                <input type="range" class="cropRange" name="xmove" id="xmove" min="0" value="0">
            </div>
            <div class="inputtools">
                <p>
                    <span>
                        <img src={{ asset('images/vertical.png') }}>
                    </span>
                    <span>vertical movement</span>
                </p>
                <input type="range" class="cropRange" name="ymove" id="ymove" min="0" value="0">
            </div>
            <br>
            <button class="cropButtons" id="zplus">
                <img src={{ asset('images/add.png') }}>
            </button>
            <button class="cropButtons" id="zminus">
                <img src={{ asset('images/minus.png') }}>
            </button>
            <br>
            <button id="cropSubmit">submit</button>
            <button id="closeCrop">Close</button>
        </div>
    </div>

    {{-- {{ FIle  }} --}}
    <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf
        <img id="croppedImage" />
        <input type="file" id="img_submit" />
        <input type="submit" name="submit"/>
    </form>    
   
    <script>

        $("#upphoto").finecrop({
            viewHeight: 500,
            cropWidth: 200,
            cropHeight: 200,
            cropInput: 'inputImage',
            cropOutput: 'croppedImage',
            zoomValue: 50
        });
    </script>

    {{-- {{ form }} --}}
   
    {{-- {{ form }} --}}
</body>
<script type="text/javascript">



  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</html>
