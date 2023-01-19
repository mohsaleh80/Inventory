<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory MS</title>
    <link rel="shortcut icon" href="{{asset('backend/assets/images/logo-sm.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ad84e81c25.js" crossorigin="anonymous"></script>
   <!-- <link rel="stylesheet" href="style.css">-->
   <style >

@import url('https://fonts.googleapis.com/css2?family=Lato&family=Pacifico&family=Righteous&family=Roboto+Condensed:wght@300;400&display=swap');

body {

    padding: 0%;
    margin: 0%;
    font-family: 'lato';
}

.navbar-brand{

    font-family: 'Pacifico';
    font-size: 35px;
    color:lightcoral !important;
}

.nav-link{
    font-family:'Roboto Condensed';
    font-size: 16px;
    margin: 15px;
    color: white !important;;
}

.nav-link:hover{
    color: #00E8E8 !important;   
}

.nav-link.active {
    color:#00E8E8 !important;
}

.menu-right-btn{
    background-color: black !important; 
}
.menu-right-btn:hover {
    background-color: #00E8E8 !important; 
    color:whitesmoke;
}
.site-content{
    background-image: url({{ asset('frontend/assets/images/inventory_1.jpg') }});
    background-attachment: fixed;
    background-size: 100% 100%;
    height:450px;
    
    
}

.site-desc , .site-title {
    font-family: '';
}

.site-title{
     margin-top: 10%;
}

.main-btn{
    margin-top: 10%;
    margin-bottom: 40%;
    font-family: '';
}

.feature-section{
    margin-top: 5%;  
}

.feature-section .feature-head-2{
    margin-bottom: 5%;
}

.feature-section .feature-p-1{
    width:60%;
    margin: 0 auto 5% auto;
}

.feature-section .feature-p-1, .card-text{

    color: rgba(0,0,0,0.69);
}

.card {
    margin-bottom: 8%;
    height: auto;
}


  
  
   </style>

   
  </head>
  <body>
     <header>
        <nav class="navbar navbar-expand-lg bg-dark" >
            <div class="container-fluid ">
              <h5 class="logo-lg">
                        <img src="{{asset('backend/assets/images/logo-sm.png')}}" alt="logo-light" height="20">
                        <strong class="text-white">Inventory MS</strong>
             </h5>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0 ">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                      </li> 
                      <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#">Pages</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Contact us</a>
                      </li>
                    </ul>

                    <form class="form-inline my-0 me-lg-0 ">
                        <a class="btn menu-right-btn border btn-secondary" type="submit" href="{{ route('login') }}" >  
                            Login                 
                       </a>
                    </form>
              </div>
              
            </div>
          </nav>


     </header>

     <main>
       <div class="container p-0">
         <div class="site-content">
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center">
                 <!--  <h1 class="site-title text-dark " >
                   <br> <br> 
                    </h1> 
                   <p class="site-desc text-white" > <br><br></p>
                   
                   <div class="d-flex flex-row main-btn" >
                      <input type="button" value="View Template" class="btn  site-btn-1 px-4 py-3 me-4 btn-dark text-white">
                      <input type="button" value="New Features" class="btn  site-btn-2 px-4 py-3 me-4 btn-dark text-white">
                    </div> 
                  -->
                </div>
                        
            </div>
         </div>


       </div>
     </main>

     <div class="feature-section">
           <div class="container text-center">
                <h1 class="feature-head-1">Fantastic Features</h1>
                <h1 class="feature-head-2">& Different type of template</h1>
                <p class="feature-p-1">An inventory management system is the combination of technology (hardware and software) and
                   processes and procedures that oversee the monitoring and maintenance of stocked products,
                    whether those products are company assets, raw materials and supplies, 
                    or finished products ready to be sent to vendors or end consumers
                </p>
           </div>

           <div class="row  text-center px-2 " >

              <div class="col-sm-6 col-lg-3">
                <div class="card " >
                  <img src="{{ asset('frontend/assets/images/suppliers.webp') }}" alt="responsive image" >
                  <div class="card-body">
                    <h4 class="card-title">Suppliers</h4>
                    <p class="card-text"> A business or person that make goods available to another business or service.
                       Suppliers are known as the first link in the supply chain, forming only B2B relationships and providing goods to manufacturers</p>
                  </div>
                </div>
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card " >
                  <img src="{{ asset('frontend/assets/images/categories.webp') }}" alt="Agile image" >
                  <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <p class="card-text">Category management is a retailing and purchasing concept in which the range of 
                      products purchased by a business organization or sold by a retailer is broken down into discrete
                       groups of similar or related products</p>
                  </div>
                </div>  
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card "  >
                  <img src="{{ asset('frontend/assets/images/product.webp') }}" height="205px"; alt="UI/UX image" >
                  <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <p class="card-text"> 
                    A product can be a service or an item.
                     It can be physical or in virtual or cyber form. Every product is made at a cost 
                     and each is sold at a price. The price that can be charged depends on the market,
                      the quality</p>
                  </div>
                </div>
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card  " >
                  <img src="{{ asset('frontend/assets/images/customer.webp') }}" height="205px";  alt="Digital MArketing image" >
                  <div class="card-body">
                    <h4 class="card-title">Customers</h4>
                    <p class="card-text">  A customer is an individual or business that purchases another company's goods or services.
                       Customers are important because they drive revenues; without them,
                        businesses cannot continue to exist</p>
                  </div>
                </div>  
              </div>

              
             

              
           </div>
          </div>
     


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>