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

</body>
</html>