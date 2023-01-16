<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UI</title>
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
    color: black ;
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
    background-image: url("./images/main_bkg.jpeg");
    background-attachment: fixed;
    background-size: cover;
}

.site-desc , .site-title {
    font-family: '';
}

.site-title{
     margin-top: 30%;
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
    height: 400px;
}


  
  
   </style>

   
  </head>
  <body>
     <header>
        <nav class="navbar navbar-expand-lg bg-light" >
            <div class="container-fluid ">
              <a class="navbar-brand " href="#">
                Inventory<span style="color:#00E8E8">IMS</span>
              </a>
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
                        <button class="btn menu-right-btn border btn-secondary" type="submit" href="#" >  
                            Template                 
                        </button>
                    </form>
              </div>
              
            </div>
          </nav>


     </header>

     <main>
       <div class="container-fluid p-0">
         <div class="site-content">
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column align-items-center">
                  <h1 class="site-title text-white" >
                    Bootstrap User Interface
                  </h1>
                  <p class="site-desc text-white" >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                  <div class="d-flex flex-row main-btn">
                    <input type="button" value="View Template" class="btn  site-btn-1 px-4 py-3 me-4 btn-primary">
                    <input type="button" value="New Features" class="btn  site-btn-2 px-4 py-3 me-4 btn-info text-white">
                    
                  </div> 
                </div>
                           
            </div>
         </div>


       </div>
     </main>

     <div class="feature-section">
           <div class="container text-center">
                <h1 class="feature-head-1">Fantastic Features</h1>
                <h1 class="feature-head-2">& Different type of template</h1>
                <p class="feature-p-1">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Architecto saepe rerum consequatur. 
                  Iste animi architecto, nihil eveniet atque quam odio praesentium dolore consectetur! Nulla nam, 
                  provident blanditiis ad nobis facere!
                </p>
           </div>

           <div class="row  text-center px-2 " >

              <div class="col-sm-6 col-lg-3">
                <div class="card " >
                  <img src="images/responsive.png" alt="responsive image" >
                  <div class="card-body">
                    <h4 class="card-title">Responsive</h4>
                    <p class="card-text"> (RWD) is a web development approach that creates dynamic changes to the appearance of a website,
                       depending on the screen size and orientation of the device being used to view it</p>
                  </div>
                </div>
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card " >
                  <img src="./images/agile.jpg" alt="Agile image" >
                  <div class="card-body">
                    <h4 class="card-title">Agile</h4>
                    <p class="card-text"> Agile working is about bringing people, processes, connectivity and technology, 
                      time and place together to find the most appropriate and effective way of working to carry out a particular task.</p>
                  </div>
                </div>  
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card "  >
                  <img src="./images/responsive.png" alt="UI/UX image" >
                  <div class="card-body">
                    <h4 class="card-title">UI/UX</h4>
                    <p class="card-text"> 
                      Both are important facets of the custom software development process, and both involve working closely
                       with users to create interfaces that are both effective and easy to use.</p>
                  </div>
                </div>
              </div>

              <div class=" col-sm-6 col-lg-3">
                <div class="card  " >
                  <img src="./images/DM.png" alt="Digital MArketing image" >
                  <div class="card-body">
                    <h4 class="card-title">Digital Marketing</h4>
                    <p class="card-text"> the promotion of brands to connect with potential customers using the internet and other forms of digital communication. This includes not only email, social media,
                       and web-based advertising</p>
                  </div>
                </div>  
              </div>

              
             

              
           </div>
          </div>
     


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>