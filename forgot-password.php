<?php 
    include "template/header.php";
?>

    <!-- Start Preloader Area -->
    <div class="profile-authentication-area large-gap">
        <div class="container">
            <div class="forgot-password-form">
                <h2>Olvide mi contraseña</h2>

                <form class="form" id="forgot-form">
                    <div class="form-group">
                        <label>Ingresa aqui tu email</label>
                        <input name="email" type="email" class="form-control">
                    </div>
                    <button type="submit" class="default-btn">Enviar</button>
                    <input type="hidden" name="operation" value="forgot">
                </form>
            </div>
        </div>
    </div>
    <!-- End Preloader Area -->

<?php 
    include "template/footer.php";
?>