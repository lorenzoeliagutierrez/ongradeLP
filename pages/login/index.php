<!DOCTYPE html>
<html>
    
<head>
  <title>My Awesome Login Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <style>
      /* Coded with love by Mutiullah Samim */
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      background-image: url(../../assets/img/hallway.jpg) !important;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      display: block;

    }
    .user_card {
      height: 50%;
      width: 350px;
      margin-top: auto;
      margin-bottom: auto;
      background: rgba(255, 255, 255, 0.6);
      position: relative;
      display: flex;
      justify-content: center;
      flex-direction: column;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      border-radius: 5px;

    }
    .brand_logo_container {
      position: absolute;
      height: 170px;
      width: 170px;
      top: -75px;
      border-radius: 50%;
      background: transparent;
      padding: 10px;
      text-align: center;
    }
    .brand_logo {
      height: 150px;
      width: 150px;
      border-radius: 50%;
      border: 2px solid white;
    }
    .form_container {
      margin-top: 100px;
    }
    .login_btn {
      width: 100%;
      background: rgba(255, 0, 0, 0.3999999) !important;
      color: white !important;
    }
    .login_btn:focus {
      box-shadow: none !important;
      outline: 0px !important;
    }
    .login_container {
      padding: 0 2rem;
    }
    .input-group-text {
      background: rgba(255, 0, 0, 0.3999999) !important;
      color: white !important;
      border: 0 !important;
      border-radius: 0.25rem 0 0 0.25rem !important;
    }
    .input_user,
    .input_pass {
      box-shadow: none !important;
      outline: 0px !important;
      background: transparent !important;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
      background-color: #c0392b !important;
    }
    .input_user::placeholder,
    .input_pass::placeholder{
      
      color: white;
    }
    .input_user,
    .input_pass
    {
      background: rgba(0,0,0,0.3) !important;
      border: none;
      border-bottom: 1px solid #fff;
    }
    

  </style>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
  <div class="container h-100" style="-webkit-filter: blur(-5px);">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card col-sm-4">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <img src="../../img/logo.png" class="brand_logo" alt="Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="" style="color: white" class="form-control input_user" value="" placeholder="username"  autofocus>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="" style="color: white" class="form-control input_pass" value="" placeholder="password">
            </div>
            
          </form>
        </div>
        <div class="d-flex justify-content-center mt-3 login_container">
          <button type="button" name="button" class="btn login_btn">Login</button>
        </div>
        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            <a href="#">Forgot your password?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
