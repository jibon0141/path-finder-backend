<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Dashboard</title>
    <!-- Links start -->
    @include('admin.include.extraLink')
    <!-- Links end -->
    <!-- all needed css start -->
    @include('admin.include.css')
    <!-- all css file to needed  -->
  </head>
  <body class="light">
    <!-- header part start -->
    <header>
      @include('admin.include.header')
    </header>
    <!-- header part end -->
    <!-- Main part start -->
    <main class="main-body">
      
      <!-- Aside bar start -->
      <aside class="sidebar-main uv-nav-bg ">
        @include('admin.include.aside')
      </aside>
      <!-- Aside bar end -->
      <!-- ################################ Main Content start here ################################## -->
      <section class="main-content primary-bg primary-text ">
        @include('admin.include.headerNav')
        <!-- content  -->
        <div class="p-1 p-md-2 p-lg-3 mt-3" id="content">
          @yield('content')
        </div>
      </section>
      <!-- ################################ Main Content end here ################################## -->
    </main>
    <!--  all js part start -->
    @include('admin.include.js')
    <!--  all js part start -->
    
  </body>
</html>


