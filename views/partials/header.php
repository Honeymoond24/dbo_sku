<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title><?php echo $page_name; ?></title>
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Система проведения письменного экзамена в СКУ </h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Профиль</a>
            <!-- <a class="p-2 text-dark" href="#">Справка</a> -->
            <a class="btn btn-outline-primary" id="sign_in">Войти</a>
            <a class="btn btn-outline-primary" id="sign_up">Зарегистрироваться</a>
        </nav>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let sign_in = document.getElementById('sign_in')
        sign_in.addEventListener('click', async function() {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Авторизация',
                html: '<input id="email" class="swal2-input" placeholder="Электронная почта">' +
                      '<input id="password" class="swal2-input" placeholder="Пароль">',
                focusConfirm: false,
                confirmButtonColor: '#05a4ba',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Войти',
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ]
                }
            })
        })
    </script>
    <script>
        let sign_up = document.getElementById('sign_up')
        sign_up.addEventListener('click', async function() {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Регистрация',
                html: '<input name="email" class="swal2-input" placeholder="Электронная почта">' +
                      '<input name="password1" class="swal2-input" placeholder="Пароль">' +
                      '<input name="password2" class="swal2-input" placeholder="Подтверждение пароля">',
                focusConfirm: false,
                confirmButtonColor: '#05a4ba',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Зарегистрироваться',
                preConfirm: () => {
                    const data = { 
                    type: 'add', 
                    id_city: select_city.value, 
                    name: document.getElementById('swal-input1').value, 
                    address: document.getElementById('swal-input2').value, 
                    latitude: document.getElementById('swal-input3').value, 
                    longitude: document.getElementById('swal-input4').value 
                    } 
                    sendRequest('POST', '../rest-api.php/places', data); 
                }
            })
        })
    </script>
    <script>
        preConfirm: () => { 
            
        }
    </script>