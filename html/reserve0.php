<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="icon" href="../src/SH.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Social Help</title>
</head>
<body>
    <nav>
        <div class="logo">
             <h1>Social Help</h1>
        </div>
        <ul class="headers" id="menu">
            <li ><a href="##"></a></li>
        </ul>
    </nav>
    <main>
        <i onclick=" history.back()" class="fa-solid fa-arrow-left"></i>
        <p>Selectionner le Service que vous voulez reserver</p>
        <div class="btn">
            <button><a href="reservemenage.php">Ménage</a></button>  
            <button><a href="reserveavs.php">Aide a la personne</a></button>    
        </div>
    </main>

</body>   
<style>
    *{
    margin: 0px;
    padding: 0px;
    box-sizing: 0;
    font-family: 'Times New Roman', Times, serif;
    --vert: rgba(73, 230, 73, 0.795);
    --blanc: #FFFFFF;
    --gris: #3D3D3D;
}
nav{
    width: 100%;
    height: 60px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    position: relative;
    background-color: var(--blanc);

}
nav .logo{
    color: var(--vert);
    font-size: 1.7rem;
    font-style: italic;
    margin-left:50px ;
}
.headers li{
   font-size: 1.2rem;
   
}
nav ul{
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    text-align: center;
    position: relative;
    list-style: none;
    width: 70%;
}
a{
    text-decoration:none;
    color: white;
}
body{
    margin: 0px;
    padding: 0px;
    height: 100vh;
    display:flex;
    flex-direction: column;
}
main{
    width: 100%;
    height: 90%;
    display: flex;
    flex-direction: column;
    background-color: #ECECEC;
    align-items: center;
    justify-content: center;
}
p{
    font-size: 2.5rem;
    color: var(--vert);
    position: relative;
   bottom: 15%;
    text-align: center;
    font-style: bold;
    
}
.btn{
    display: flex;
    flex-direction: row;
    gap: 30px;
    align-items: center;
    border: none;
}
button{
    color: white;
    background-color: var(--vert);
    border: none;
    border-radius: 5px;
    font-size: 25px;
    padding:10px;
    width: 300px;
    font-style: bold;
}
i{
    font-size: 2.5rem;
    color: var(--vert);
    position: relative;
    bottom:35%;
    right:45%;
}
</style>
</html>