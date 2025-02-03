<?php

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione Contatto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .image-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 2px dashed #ccc;
        }
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        input:focus, textarea:focus {
            box-shadow: 0px 0px 10px rgba(118, 75, 162, 0.5) !important;
            border-color: #764ba2 !important;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3 class="text-center text-primary">Nuovo Contatto</h3>
        <form>
            <div class="text-center">
                <div class="image-preview" id="imagePreview">
                    <span>+</span>
                </div>
                <input type="file" class="form-control mt-2" id="photo" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" placeholder="Inserisci il nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cognome</label>
                <input type="text" class="form-control" placeholder="Inserisci il cognome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Inserisci l'email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Organizzazione</label>
                <input type="text" class="form-control" placeholder="Inserisci l'organizzazione">
            </div>
            <div class="mb-3">
                <label class="form-label">Numero di cellulare</label>
                <input type="tel" class="form-control" placeholder="Inserisci il numero" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Salva Contatto</button>
        </form>
    </div>
    
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imagePreview = document.getElementById("imagePreview");
                imagePreview.innerHTML = `<img src="${reader.result}" alt="Anteprima">`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
