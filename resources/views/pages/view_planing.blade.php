<!-- view.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planing {{ $date }}</title>
    <script src="https://unpkg.com/tabulator-tables@4.9.3/dist/js/tabulator.min.js"></script>
    <link href="https://unpkg.com/tabulator-tables@4.9.3/dist/css/tabulator.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .responsive-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-container {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
}

/* The Modal (background) */
.image-modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
}

/* Modal Content (image) */
.image-modal-content {
    margin: auto;
    display: block;
    width: 100%;
}

/* Caption of Modal Image */
.image-modal-content, .close {
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}
    </style>
</head>

<body>
    <div class="container">
        <h1>Planning {{ $date }}</h1>

        @if (isset($imagePath))
            @if ($imagePath)
                <img src="{{ Storage::url($imagePath) }}" onclick="zoom()" id="img" alt="Uploaded Image" class="responsive-image">
                <div id="imageModal" class="image-modal">
                    <span class="close">&times;</span>
                    <img class="image-modal-content" id="imgZoom">
                </div>
            @endif
        @else
            <p class="error-message">{{ $error }}</p>
        @endif
        <br>
        <div class="form-container">
            <form action="{{ route('show_planing') }}" method="GET">
                <label for="date">Choisissez la date:</label>
                <input type="date" name="date" id="date" required>
                <button type="submit">بحث</button>
            </form>
        </div>
        
<div class="col-12" style="display: contents;">
    <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
</div>
    </div>
</body>
<script>
    Number.prototype.AddZero = function(b, c) {
        var l = (String(b || 10).length - String(this).length) + 1;
        return l > 0 ? new Array(l).join(c || '0') + this : this;
    } //to add zero to less than 10,

    var d = new Date(),
        localDate = [d.getFullYear(), (d.getMonth() + 1).AddZero(),
            d.getDate().AddZero()
        ].join('-');
    var elem = document.getElementById("date");
    elem.value = localDate;
    function zoom() {
        img = document.getElementById("img");
        img.addEventListener('click', function() {
                    const modal = document.getElementById('imageModal');
                    const modalImg = document.getElementById('imgZoom');
                    modal.style.display = "block";
                    modalImg.src = this.src;
                });
        const modal = document.getElementById('imageModal');
        const span = document.getElementsByClassName('close')[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
        modal.onclick = function() {
            modal.style.display = "none";
        }
    }
</script>

</html>
