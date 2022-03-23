<?php
    include "template/header.php";
?>
        
        <!-- Start Preloader Area -->
        <div class="profile-authentication-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="profile-authentication-image">
                            <div class="content-image">
                                <div class="logo">
                                    <a href="index.html"><img src="assets/images/logo.png" alt="Zust"></a>
                                </div>
                                <div class="vector-image">
                                    <img src="assets/images/vector.png" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Acceso</h2>
        
                            <form class="form" method="post" id="access-form">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input name="email" type="text" class="form-control">
                                </div>
        
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input name="password" type="password" class="form-control">
                                </div>
        
                                <div class="remember-me-wrap d-flex justify-content-between align-items-center">
        
                                    <div class="lost-your-password-wrap">
                                        <a href="forgot-password.html">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                                <button type="submit" class="default-btn">Ingresar</button>
                                <input type="hidden" name="operation" value="login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Preloader Area -->
        
<?php 
    include "template/footer.php";
?>