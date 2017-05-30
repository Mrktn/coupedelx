<div class="jumbotron jumbo-header">
    <h1 class="jumbo-title">Informations pratiques</h1>
</div>

<div class="container-fluid">Vous trouverez ici différentes informations pour vous repérer sur le campus le jour J ! S'il vous restait le moindre doute, n'hésitez pas à <a href="index.php?page=contact">nous contacter</a> !
    <hr class="featurette-divider" style="margin-bottom:10px;margin-top:20px">
</div>

<div class="container-fluid" style="">
    <h2>Plan du campus et des activités</h2>

    Vous trouverez ci-dessous un plan du campus qui vous sera utile pour trouver le lieu de votre épreuve ou encore pour aller encourager vos camarades. Le campus est vaste, aussi pensez à prendre vos dispositions pour ne pas arriver en retard à vos matchs !
    <p><b><span style="color:red">ATTENTION !</span></b> En raison du plan Vigipirate en vigueur sur le campus, pensez à vous munir d'une <b>pièce d'identité</b> lors de vos déplacements !</p>

    <img class="img-responsive" id="myImg" src="img/imageplanCdx.jpg" alt="Plan des activités" width="200">

    <div id="myModal" class="modal">
        <span class="close" onclick="document.getElementById('myModal').style.display = 'none'">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        }</script>
    <br><br><br>
    <h2>Déroulement de la journée</h2>

    <p>Pendant l'ensemble de la compétition, un village sportif sera dressé (voir plan du site). Au-delà des différents lieux où se dérouleront les tournois, ce village constituera le coeur de l'évènement. C'est d'ailleurs à cet endroit que se fera l'accueil le matin.</p>
    <p>Toute la journée l'animation sera au rendez-vous grâce au son de Vibes et à de nombreuses autres activités. Vous pourrez également y trouver à manger grâce à des stands mis en place pour cette journée. Si votre école ou votre association veut monter un stand, n'hésitez pas à nous contacter !</p>

    Sous réserve de modifications par l'équipe organisatrice, voici le déroulé de la journée :
    <ul>
        <li>8h: accueil des équipes au village sportif et orientation vers les différents terrains. Les responsables d'équipes pourront récupérer les paniers repas pour leurs joueurs</li>
        <li>8h30: début des phases de poules pour la majorité de sports, selon le planning de rencontres qui sera communiqué quelques jours avant le tournoi</li>
        <li>12h: début des phases éliminatoires</li>
        <li>13h15: relais natation (13h15 entrée des équipes, début des courses à 14h)</li>
        <li>17h30: relais course au stade de l'École polytechnique</li>
        <li>18h15: concours PomPom au gymnase de l'ENSTA</li>
        <li>19h: remise des récompenses au gymnase de l'ENSTA</li>
    </ul>

    Enfin, le soir aura lieu la <b>Nuit du Styx</b>, soirée organisée par le Styx (sono de l'École) et la Kès (BDE). Une "transition" entre la fin de la Coupe de l'X et le début de la Nuit du Styx sera également organisée.

    <br><br><br>

    <h2></h2>
</div>