<?php
include_once 'header.php';
?>

    <h1 id="index-text">Добро пожаловать, <?php if (isset($_SESSION['IDUser'])) {
            echo explode(" ", $_SESSION['usersFullName'])[1];
        } else {
            echo 'Гость';
//            echo phpinfo();
        }
        ?>
    </h1>


<?php
include_once 'footer.php';
?>
<?php
/*
function sendRequest(method, url, body = null) {
const headers = {
'Content-Type': 'application/json'
}

return fetch(url, {
method: method,
headers: headers,
body: JSON.stringify(body)
})
}

function insertHTML(url, data, div_class) {
$.ajax({
type: 'POST',
url: url,
data: data,
response: 'text',
success: function(data) {
$(div_class).html(data);
$(div_class).hide().fadeIn(700);
}
})
}

function sendRequestWithImage(url, body) {
return fetch(url, {
method: 'POST',
body: body
})
}
*/
?>
