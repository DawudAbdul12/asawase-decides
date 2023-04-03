@extends('admin.template')


@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <main id="main-container">

        <div class="content">
            <div class="container">
                <div class="row">
                      
                 
                   <div class="col-12 col-md-12  spaced">
                        <h1 class="page-heading">Dashboard</h1>
                        <p>Welcome to  Admin Dashboard</p>
                   </div>
                  
  
                    <div class="col-12 col-md-6 col-lg-3">
                         <div class="well well2">
                             <div class="card-body flex">
                                  <div>
                                      <h1 class="boldtitile">{{ $total_subscribers }} </h1>
                                      <p>Total Subscribers</p>
                                  </div>
                                  <div class="item item-rounded-lg bg-body-light">
                                      <i class="si si-book-open  bigicon"></i>
                                  </div>
                             </div>
                               <a href="#"> All Subscribers</a>
                         </div>
                    </div>
  
                    <div class="col-12 col-md-6 col-lg-3">
                      <div class="well well2">
                          <div class="card-body flex">
                                      <div>
                                          <h1 class="boldtitile">{{ $total_businesses }}</h1>
                                          <p>Total business(es)</p>
                                      </div>
                                      <div class="item item-rounded-lg bg-body-light">
                                          <i class="si si-home  bigicon"></i>
                                      </div>
                                  </div>
                                  <a href="/admin/business">View all</a>
                              </div>
                      </div>
  
                      <div class="col-12 col-md-6 col-lg-3">
                          <div class="well well2">
                              <div class="card-body flex">
                                          <div>
                                              <h1 class="boldtitile">{{ $total_personals }}</h1>
                                              <p>Total Person(s)</p>
                                          </div>
                                          <div class="item item-rounded-lg bg-body-light">
                                              <i class="si si-user  bigicon"></i>
                                          </div>
                                      </div>
                                      <a href="/admin/person">View All  </a>
                                  </div>
                          </div>
  
                          <div class="col-12 col-md-6 col-lg-3">
                              <div class="well well2">
                                  <div class="card-body flex">
                                              <div>
                                                  <h1 class="boldtitile">{{ $total_users }}</h1>
                                                  <p>Total User(s)</p>
                                              </div>
                                              <div class="item item-rounded-lg bg-body-light">
                                                  <i class="si si-users bigicon"></i>
                                              </div>
                                          </div>
                                          <a href="/admin/user">View all </a>
                                      </div>
                              </div>
                </div>
  
                <div id="app">
                    {!! $chart->container() !!}
                </div>
            </div>
          </div>   

          <script src="https://unpkg.com/vue"></script>
          <script>
              var app = new Vue({
                  el: '#app',
              });
          </script>
          <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
          {!! $chart->script() !!}
       
    </main>
@endsection