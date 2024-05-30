<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    text-align: left;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="number"], input[type="file"] {
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
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

.image-preview-container {
    margin-top: 20px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
    background-color: #f9f9f9;
    max-width: 100%;
    max-height: 400px; /* Maximum height for the container */
    overflow: auto; /* Scroll if the content overflows */
}

.responsive-image {
    max-width: 100%;
    max-height: 100%; /* Ensures the image fits within the container */
    display: block;
    margin: 0 auto;   cursor: pointer;
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
        @if($attestation ?? '')
        <div class="alert alert-success">
            Operation effectuee avec succes.
        </div>
        @elseif($deja_demmander ?? '')
        <div class="alert alert-warning">
            Vou avez deja demmander une attestation.
        </div>
        @elseif($error ?? '')
        <div class="alert alert-warning">
            Operation echoue. Veuillez reessayer.
        </div>
        @endif

        <form action="{{ route('demande_attestations') }}" method="POST" >
            @csrf
            
            <h2>Demander votre Attestation de travail</h2>


            <button type="submit">Demander</button>
        </form>

        <div class="col-12" style="display: contents;">
            <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
        </div>
    </div>
</body>
</html>
