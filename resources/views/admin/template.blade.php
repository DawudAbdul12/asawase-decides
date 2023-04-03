<style>
  
    .spaced {
       padding-bottom: 2rem;
    }
  
     .boldtitile {
         font-size: 4rem;
         font-weight: 700
     }
  
     .bigicon {
          font-size: 3rem;
      }
  
      .flex {
          display: flex;
          justify-content: space-between;
  
      }
  
           .item {
                  display: flex !important;
                  align-items: center;
                  justify-content: center;
                  width: 4rem;
                  height: 4rem;
                  transition: opacity .25s ease-out,transform .25s ease-out;
              }
  
              .bg-body-light {
                  background-color: #f6f7f9!important;
              }
  
              .item.item-rounded-lg {
                  border-radius: 1.5rem;
              }
  
               .well2{
                  background-color:  #ffffff !important;
                   border: 0px solid #ffffff !important;
               }
  
  </style>
  
<!DOCTYPE html>
    <!--[if IE 9]>         
    <html class="ie9 no-focus"> <![endif]-->
    <!--[if gt IE 9]><!-->
        <html class="no-focus"> 
    <!--<![endif]-->
    @include('admin.components.header_links')
    <body>

        <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
            <!-- Side Overlay-->
            {{-- @include('admin.components.sidebar') --}}
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            @include('admin.components.navigation_bar')
            <!-- END Sidebar -->

            <!-- Header -->
            @include('admin.components.header')
            <!-- END Header -->

            @include('messages')
            
            <!-- Main Container -->
            @yield('content')
            <!-- END Main Container -->

            <!-- Footer -->
            @include('admin.components.footer')
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        @include('admin.components.model')
        <!-- END Apps Modal -->

        @include('admin.components.footer_link')
        
     
    </body>
</html>