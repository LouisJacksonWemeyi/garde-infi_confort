<div class="container">
    <h1>Chercher un prestataire</h1>
    <h2>You are in the View: application/view/song/index.php (everything in this box comes from that file)</h2>
    
    <form>
        <label>Nom</label><input type="text">
        <label>prenom</label><input type="text">
    </form>
    
    
    <!-- add song form -->
    <div class="box">
        <h3>Add a song</h3>
        <form action="<?php echo URL; ?>songs/addsong" method="POST">
            <label>Artist</label>
            <input type="text" name="artist" value="" required />
            <label>Track</label>
            <input type="text" name="track" value="" required />
            <label>Link</label>
            <input type="text" name="link" value="" />
            <input type="submit" name="submit_add_song" value="Submit" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>Amount of songs: <?php echo $amount_of_songs; ?></h3>
        <h3>Amount of songs (via AJAX)</h3>
        <div id="javascript-ajax-result-box"></div>
        <div>
            <button id="javascript-ajax-button">Click here to get the amount of songs via Ajax (will be displayed in #javascript-ajax-result-box ABOVE)</button>
        </div>
        <h3>List of songs (data from model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Adresse</td>
                <td>Numéro</td>
                <td>Boîte</td>
                <td>CP</td>
                <td>ViLLE</td>
                <td>Mail</td>
                <td>Téléphone</td>
                <td>INAMI</td>
                <td>TVA</td>
                <td>Disponibilité</td>
                <td>Commentaire</td>
                
            </tr>
            </thead>
            <tbody>
            <?php foreach ($songs as $song) { ?>
                <tr>
                    <td><?php if (isset($song->id)) echo htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->nom)) echo htmlspecialchars($song->nom, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->prenom)) echo htmlspecialchars($song->prenom, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->adresse)) echo htmlspecialchars($song->adresse, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->numero)) echo htmlspecialchars($song->numero, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->boite)) echo htmlspecialchars($song->boite, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->cp)) echo htmlspecialchars($song->cp, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->ville)) echo htmlspecialchars($song->ville, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->mail)) echo htmlspecialchars($song->mail, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->telephone)) echo htmlspecialchars($song->telephone, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->inami)) echo htmlspecialchars($song->inami, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->tva)) echo htmlspecialchars($song->tva, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->disponibilite)) echo htmlspecialchars($song->disponibilite, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($song->commentaire)) echo htmlspecialchars($song->commentaire, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (isset($song->link)) { ?>
                            <a href="<?php echo htmlspecialchars($song->link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($song->link, ENT_QUOTES, 'UTF-8'); ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo URL . 'songs/deletesong/' . htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($song->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
