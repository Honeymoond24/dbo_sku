</div>
<div class="container mt-4">
    <div class="pt-4 pt-md-5 border-top" id="footer">
        <div class="row m-0">
            <div class="col-6 col-md">
                <h5>Разработали проект:</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Жантурин Д.Р.</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Долгушин Н.Л.</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Серикова Д.Л.</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Отладка</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#"><?php echo '$_COOKIE: ';
                            var_dump($_COOKIE); ?></a></li>
                    <li><a class="text-muted text-decoration-none" href="#"><?php echo '$_POST: ';
                            var_dump($_POST); ?></a></li>
                    <li><a class="text-muted text-decoration-none" href="#"><?php echo '$_REQUEST: ';
                            var_dump($_REQUEST); ?></a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Отладка</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#"><?php echo '$_SESSION: ';
                            var_dump($_SESSION); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function insertHTML(url, data, div_class) {
        $.ajax({
            // headers: {
            //     'Content-Type': 'application/json'
            // },
            type: 'POST',
            url: url,
            dataType: 'json',
            data: data,
            response: 'text',
            success: function (data) {
                $(div_class).html(data);
                console.log('ajax', data);
            }
        })
    }

    insertHTML('controllers/Controls.php', {'type': 'GetControls'}, 'list-group-item')

    // function insertHTML(url, data, div_class) {
    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: data,
    //         response: 'text',
    //         success: function (data) {
    //             $(div_class).html(data);
    //             $(div_class).hide().fadeIn(700);
    //         }
    //     })
    // }

    // function sendRequest(method, url, body = null) {
    //     const headers = {
    //         'Content-Type': 'application/json'
    //     }
    //
    //     return fetch(url, {
    //         method: method,
    //         headers: headers,
    //         body: JSON.stringify(body)
    //     })
    // }

    // function sendRequestWithImage(url, body) {
    //     return fetch(url, {
    //         method: 'POST',
    //         body: body
    //     })
    // }
</script>
</body>
</html>