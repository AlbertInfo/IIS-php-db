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
        .container-custom {
            display: flex;
            gap: 20px;
            width: 90%;
            max-width: 1000px;
        }
        .contacts-container, .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .contacts-container {
            width: 50%;
            max-height: 500px;
            overflow-y: auto;
        }
        .form-container {
            width: 50%;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .contact-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .contact-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .contact-buttons button {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="contacts-container">
            <h4 class="text-primary">Contatti Salvati</h4>
            <div class="contact-item">
                <img src="./foto-profilo-semplice.png" class="contact-image" alt="Foto Contatto">
                <div>
                    <strong>Mario Rossi</strong><br>
                    <small>+39 123 456 7890</small>
                </div>
                <div class="contact-buttons">
                    <button class="btn btn-sm btn-warning">Modifica</button>
                    <button class="btn btn-sm btn-danger">Elimina</button>
                </div>
            </div>
        </div>
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
