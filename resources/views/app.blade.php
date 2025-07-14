<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite('resources/css/app.css')

    <!-- build:css assets/vendor/css/theme.css  -->
    
    <link rel="stylesheet" href="{{ url('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/font_lao.css') }}">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
</head>
<body>
    
    <div id="app" ></div>


     @vite('resources/js/app.js')


         <!-- Core JS -->
    
    
    <script src="{{ url('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/js/bootstrap.js') }}"></script>

    

    
      <script src="{{ url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      
      <script src="{{ url('assets/vendor/js/menu.js') }}"></script>
    
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    
      <script src="{{ url('assets/js/main.js') }}"></script>

</body>
</html>