<?php
    include "template/header.php";
?>
        
        <!-- Start Preloader Area -->
        <div class="profile-authentication-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="profile-authentication-image">
                            <div class="d-table">
                                <div class="d-table-cell">
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
                        </div>
                    </div>
    
                    <div class="col-lg-6 col-md-12">
                        <div class="register-form">
                            <h2>Registrate</h2>
        
                            <form id="register-form" class="form" method="post">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input name="nameu" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input name="lastname" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Nombre de Usuario</label>
                                    <input name="username" type="text" class="form-control">
                                    <span class="form-text text-secondary" style="font-size: small;">Este sera el nombre que aparecera en tu perfil</span>
                                </div>


                                <div class="form-group">
                                    <label>Correo</label>
                                    <input name="email" type="email" class="form-control">
                                </div>
        
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input name="password" type="password" class="form-control">
                                </div>

                                <button type="submit" class="default-btn">Register</button>
                                <input type="hidden" name="operation" value="register">

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