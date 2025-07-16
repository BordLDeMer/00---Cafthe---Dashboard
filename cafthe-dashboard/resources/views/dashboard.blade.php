<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #c8e6c9;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }
        .navbar a {
            color: #1b5e20;
            text-decoration: none;
            margin: 0 10px;
        }
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .card {
            background-color: #81c784;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: white;
        }
        .product-card {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #1b5e20;
        }
        .product-card img {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <a href="#">Café</a>
        <a href="#">Home</a>
        <a href="#">Nos produits</a>
        <a href="#">Actualités</a>
    </div>
    <div>
        <a href="#">Espace Vendeur</a>
    </div>
</div>
<div class="dashboard">
    <div class="card">
        <h2>CHIFFRE AFFAIRE MOIS</h2>
        <h1>1 000 000 €</h1>
    </div>
    <div class="card">
        <h2>BALANCE MENSUELLE</h2>
        <h1>+100 000 €</h1>
    </div>
    <div class="card">
        <h2>MEILLEURE VENTE DU MOIS</h2>
        <div class="product-card">
            <img src="https://via.placeholder.com/150" alt="Turkish Coffee">
            <h3>Turkish Coffee</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>$4.06</p>
        </div>
    </div>
    <div class="card">
        <h2>PRODUIT EN RECUL</h2>
        <div class="product-card">
            <img src="https://via.placeholder.com/150" alt="Turkish Coffee">
            <h3>Turkish Coffee</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            <p>$4.06</p>
        </div>
    </div>
</div>
</body>
</html>
