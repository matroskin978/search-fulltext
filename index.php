<?php

$dsn = "mysql:host=localhost;dbname=np;charset=utf8";
$opt = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
$db = new PDO($dsn, 'root', 'root', $opt);

if (!empty($_GET['search'])) {
    var_dump($_GET['search']);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'search') {
        if (!empty($_POST['search'])) {
            $search = trim($_POST['search']);
            $stmt = $db->prepare("select id, title from articles where match (title,body) against (? in boolean mode)");
            $stmt->execute(["{$search}*"]);
            $html = '';
            if ($res = $stmt->fetchAll()) {
                foreach ($res as $item) {
                    $html .= '<li data-id="' . $item['id'] .  '" data-value="' . h($item['title']) . '">' . h($item['title']) . '</li>';
                }
            }
            echo $html;
            die;
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Fulltext</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        #search {
            padding-right: 40px;
        }

        .search-form .btn {
            text-decoration: none;
            position: absolute;
            right: 0;
            top: 0;
        }

        .spinner-loader {
            position: absolute;
            right: 40px;
            top: 10px;
            border-radius: 50% !important;
            display: none;
        }

        .search-results {
            position: absolute;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,.2);
            width: 100%;
            list-style: none;
            padding-left: 0;
            max-height: 300px;
            overflow-y: auto;
            z-index: 2;
            display: none;
        }

        .search-results li {
            padding: 10px;
            cursor: pointer;
            font-size: 15px;
            line-height: 17px;
            display: block;
            color: #333;
            text-decoration: none;
            transition: all .3s;
        }

        .search-results li:hover {
            background: aliceblue;
        }
    </style>
</head>
<body>

<div class="container my-5">

    <div class="row">

        <div class="col-md-6 offset-md-3">

            <form action="" class="search-form">

                <div class="mb-3 position-relative">

                    <input type="text" name="search" id="search" class="form-control" placeholder="Searching..." autocomplete="off">
                    <button type="submit" class="btn btn-link">🔍</button>

                    <ul class="search-results" id="search-results">

                    </ul>

                    <div class="spinner-border spinner-border-sm spinner-loader" role="status" id="spinner-loader">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function () {

        let searchInput = $('#search');
        let searchResults = $('#search-results');
        let loader = $('#spinner-loader');

        searchInput.on('focus', function () {
            searchResults.fadeIn();
        });

        searchInput.on('blur', function () {
            searchResults.fadeOut();
        });

        searchResults.on('click', 'li', function () {
            searchInput.val($(this).data('value'));
        });

        searchInput.on('input', function () {
            let search = $.trim($(this).val());
            if (search.length > 2) {
                $.ajax({
                    url: 'index.php',
                    type: 'POST',
                    data: {
                        search: search,
                        action: 'search',
                    },
                    beforeSend: function () {
                        loader.stop(true, true).fadeIn();
                    },
                    success: function (res) {
                        searchResults.html(res);
                        loader.stop(true, true).fadeOut();
                    },
                    error: function () {
                        alert('Error searching...');
                        loader.stop(true, true).fadeOut();
                    },
                });
            }
        });

    });
</script>
</body>
</html>

