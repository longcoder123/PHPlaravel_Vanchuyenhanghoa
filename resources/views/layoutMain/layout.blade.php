<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Long FAST</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="css/header.css" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <style>
.toggle-div {
            display: none;
            padding: 20px;
            background-color: #f58220;
            color: white;
        }
        .upload-box {
  width: 100%;
  height: 150px;
  border: 1px dashed #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.upload-box i {
  font-size: 24px;
  color: #888;
}

.img-thumbnail {
  width: 100%;
  height: 150px;
  object-fit: cover;
}
.file-input-main{
    width: 300px;
}
.hidden {
  display: none;
}


    </style>
  </head>
  <body>
    @include('layoutMain.header')
    <div>
    @yield('content')
    </div>
    @include('layoutMain.footer')
  </body>
</html>
