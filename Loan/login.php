<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Bonus Emlak Dashboard</title>
    <?php include('./header.php'); ?>
    <?php include('./db_connect.php'); ?>
    <?php 
    session_start();
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
    ?>
</head>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
}

main#main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-container {
    width: 100%;
    max-width: 1200px;
    height: 600px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    display: flex;
    overflow: hidden;
}

#login-left {
    flex: 1;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url(assets/img/loan.png);
    background-size: cover;
    background-position: center;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: white;
}

#login-left h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-weight: 700;
}

#login-right {
    width: 400px;
    padding: 40px;
    background: white;
    display: flex;
    align-items: center;
}

.login-form-container {
    width: 100%;
}

.logo {
    text-align: center;
    margin-bottom: 30px;
}

.logo i {
    font-size: 3rem;
    color: #2196F3;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #666;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #2196F3;
    box-shadow: 0 0 0 2px rgba(33,150,243,0.1);
    outline: none;
}

.btn-login {
    width: 100%;
    padding: 12px;
    background: #2196F3;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background: #1976D2;
}

.alert {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-danger {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ffcdd2;
}

@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
        height: auto;
    }
    
    #login-left {
        display: none;
    }
    
    #login-right {
        width: 100%;
        padding: 20px;
    }
}
</style>

<body>
    <main id="main">
        <div class="login-container">
            <div id="login-left">
                <h1>Bonus Emlak Apart Yönetim Sistemi</h1>
            </div>
            
            <div id="login-right">
                <div class="login-form-container">
                    <div class="logo">
                        <i class="fa fa-money-check-alt"></i>
                    </div>
                    <h2 style="text-align: center; margin-bottom: 30px;">Hoş Geldiniz</h2>
                    <form id="login-form">
                        <div class="form-group">
                            <label for="username">Kullanıcı adı</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Kullanıcı Adınızı Girin">
                        </div>
                        <div class="form-group">
                            <label for="password">Şifre</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Şifrenizi Girin">
                        </div>
                        <button type="submit" class="btn-login">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

<script>
$('#login-form').submit(function(e){
    e.preventDefault();
    $(this).find('button').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i> Signing in...');
    if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
    $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
            console.log(err)
            $(this).find('button').removeAttr('disabled').html('Sign In');
        },
        success:function(resp){
            if(resp == 1){
                location.href ='index.php?page=home';
            }else if(resp == 2){
                location.href ='voting.php';
            }else{
                $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#login-form button').removeAttr('disabled').html('Sign In');
            }
        }
    })
})
</script>
</html>