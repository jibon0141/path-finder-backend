<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Uviom Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/backend_assets/assets/images/favicon.ico')}}">
    <!-- google font   -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400&display=swap"
    rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{asset('assets/backend_assets/css/login.style.css')}}">
</head>

<body>
    <div id="login-page">
        <div class="form-wrapper">
            <form class="login-form" method="POST" action="{{url('/login')}}" >
                @csrf
                <div class="form-heading">
                    <img width="fit-content" height="fit-content" src="{{asset('assets/backend_assets/assets/images/logo.svg')}}" alt="">
                    <h2>UVIOM</h2>
                </div>
                <div class="form-input-wrapper">
                    <div class="input-group mb-3">
                        <label class="input-label">Email</label>
                        <input class="input" type="text" placeholder="Email" name="email">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-label">Password</label>
                        <input class="input" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="password-hide-show">
                        <a class="forgot-password mb-3" href="#">Forgot password ?</a>
                        <span class="password-toggler">Show Password</span>
                    </div>
                    <div class="input-group checkbox">
                        <input class="input" type="checkbox" placeholder="Password" name="remember">
                        <label class="input-label">Remember Me</label>
                    </div>
                   <div class="login-btn-wrapper mb-3">
                    <button class="login-button"> Login </button>
                   </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const toggler = document.querySelector(".password-toggler");
        const input = document.querySelector("input[type=password]");
        
        toggler.addEventListener("click", function(){
            _this = this;
            const  currentStatus = _this.innerText
            if(currentStatus === "Show Password"){
                _this.innerText = "Hide Password"
                input.setAttribute("type", "text")
            }else{
                _this.innerText = "Show Password"
                input.setAttribute("type", "password")
            }
            
        })
    </script>
</body>

</html>